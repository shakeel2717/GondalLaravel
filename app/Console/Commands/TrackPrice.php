<?php

namespace App\Console\Commands;

use App\Http\Controllers\FlightSearchController;
use App\Mail\PriceAlertNotification;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TrackPrice extends Command
{

    private $ApiUrl = 'https://test.api.amadeus.com';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will Track Price for the Pending Tickets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // getting all the pending bookings
        $bookings = Booking::where('ticket_status', 'Pending')->where('track_price', true)->get();
        foreach ($bookings as $key => $booking) {
            echo "Flight Found in Tracking \n";
            $access_token = getApi();
            $flight = $this->ApiUrl . '/v2/shopping/flight-offers';
            $travel_data = [
                'originLocationCode' => json_decode($booking->routes)->itineraries[0]->segments[0]->departure->iataCode,
                'destinationLocationCode' => end(end(json_decode($booking->routes)->itineraries)->segments)->arrival->iataCode,
                'departureDate' => now()->parse(json_decode($booking->routes)->itineraries[0]->segments[0]->departure->at)->format('Y-m-d'),
                'adults' => $booking->adults,
                'children' => $booking->children,
                'infants' => $booking->infants,
                'includedAirlineCodes' => json_decode($booking->routes)->validatingAirlineCodes[0],
                'travelClass' => json_decode($booking->routes)->travelerPricings[0]->fareDetailsBySegment[0]->cabin,
                'max' => 5,
            ];
            $fields = http_build_query($travel_data);
            $url = $flight . '?' . $fields;
            $headers = array('Authorization' => 'Bearer ' . $access_token);
            $response = Http::withHeaders($headers)->get($url);
            $allFlights =  collect($response->json())['data'];
            echo "Fresh Flights Got  \n";
            echo "Data: " . json_encode($allFlights);
            foreach ($allFlights as $itineraries) {
                echo "This Flight Investigation \n";
                $newPrice = $itineraries['price']['grandTotal'];
                $newDDate = $itineraries['itineraries'][0]['segments'][0]['departure']['at'];
                $currentDDate = json_decode($booking->routes)->itineraries[0]->segments[0]->departure->at;
                if ($newPrice == $booking->amount && $newDDate == $currentDDate) {
                    // send notification to this user
                    $data['newPrice'] = $newPrice;
                    $data['currentPrice'] = $booking->amount;
                    $data['pnr'] = $booking->pnr;
                    $data['newFlightCode'] = $itineraries['validatingAirlineCodes'][0];
                    $data['currentFlightCode'] = json_decode($booking->routes)->validatingAirlineCodes[0];
                    Mail::to("travelgondal@gmail.com")->send(new PriceAlertNotification($data));
                    echo "Flight Found \n";
                } else {
                    echo "No Price Difference \n";
                }
            }
            echo "End Command \n";
        }
    }
}
