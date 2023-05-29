<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Month;
use App\Models\SearchHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class FlightSearchController extends Controller
{
    private $ApiUrl;

    public function index()
    {
        return 1;
    }

    public function getApi()
    {
        $this->ApiUrl = 'https://test.api.amadeus.com';
        $url = $this->ApiUrl . '/v1/security/oauth2/token';
        $auth_data = [
            'client_id' => option('test_client_id'),
            'client_secret' => option('test_client_secret'),
            'grant_type' => option('test_grant_type'),
        ];

        try {
            $response = Http::asForm()->post($url, $auth_data);
            $responseBody = $response->json();
            return $responseBody['access_token'];
        } catch (Exception $e) {
            return "Error";
        }
    }


    public function addingHistory($origin, $destination)
    {
        $search = new SearchHistory();
        $search->user_id = auth()->user()->id;
        $search->uri = url()->current();
        $search->origin = $origin;
        $search->destination = $destination;
        $search->save();
    }


    /**
     * Display a listing of the resource.
     */
    public function oneway($origin, $destination, $trip_type, $flight_type, $cdeparture, $adult, $children, $infant)
    {
        $access_token = $this->getApi();
        $flight = $this->ApiUrl . '/v2/shopping/flight-offers';
        $orgDate = $cdeparture; //departing date
        $travel_data = [
            'originLocationCode' => strtoupper($origin),
            'destinationLocationCode' => strtoupper($destination),
            'departureDate' => date('Y-m-d', strtotime($orgDate)),
            'adults' => $adult,
            'children' => $children,
            'infants' => $infant,
            'travelClass' => strtoupper($flight_type),
        ];
        $fields = http_build_query($travel_data);
        $url = $flight . '?' . $fields;
        $headers = array('Authorization' => 'Bearer ' . $access_token);
        $response = Http::withHeaders($headers)->get($url);
        $allFlights =  collect($response->json())['data'];

        // dd($allFlights[0]);

        $data['from'] = $origin;
        $data['to'] = $destination;
        $data['class'] = strtoupper($flight_type);
        $data['trip_type'] = $trip_type;
        $data['departure'] = $cdeparture;
        $data['adult'] = $adult;
        $data['children'] = $children;
        $data['infant'] = $infant;
        $data['minPrice'] = $this->priceMin($allFlights);
        $data['maxPrice'] = $this->priceMax($allFlights);
        $data['flightsFilters'] = $this->flightsFilter($allFlights);
        $data['nextDayRoute'] = getNextOrBackUri(true);
        $data['backDayRoute'] = getNextOrBackUri(false);
        $this->addingHistory($origin, $destination);
        return view('flight.search.index', compact('allFlights', 'data'));
    }



    public function return($origin, $destination, $trip_type, $flight_type, $cdeparture, $return,  $adult, $children, $infant)
    {
        $access_token = $this->getApi();
        $flight = $this->ApiUrl . '/v2/shopping/flight-offers';
        $orgDate = $cdeparture; //departing date
        $travel_data = [
            'originLocationCode' => strtoupper($origin),
            'destinationLocationCode' => strtoupper($destination),
            'departureDate' => date('Y-m-d', strtotime($orgDate)),
            'returnDate' => date('Y-m-d', strtotime($return)),
            'adults' => $adult,
            'children' => $children,
            'infants' => $infant,
            'travelClass' => strtoupper($flight_type),
        ];
        $fields = http_build_query($travel_data);
        $url = $flight . '?' . $fields;
        $headers = array('Authorization' => 'Bearer ' . $access_token);
        $response = Http::withHeaders($headers)->get($url);
        $allFlights =  collect($response->json())['data'];

        // dd($allFlights[0]);

        $data['from'] = $origin;
        $data['to'] = $destination;
        $data['class'] = strtoupper($flight_type);
        $data['trip_type'] = $trip_type;
        $data['departure'] = $cdeparture;
        $data['adult'] = $adult;
        $data['children'] = $children;
        $data['infant'] = $infant;
        $data['minPrice'] = $this->priceMin($allFlights);
        $data['maxPrice'] = $this->priceMax($allFlights);
        $data['flightsFilters'] = $this->flightsFilter($allFlights);
        $data['nextDayRoute'] = getNextOrBackUri(true);
        $data['backDayRoute'] = getNextOrBackUri(false);
        $this->addingHistory($origin, $destination);
        return view('flight.search.index', compact('allFlights', 'data'));
    }




    public function flightsFilter($flights)
    {
        $flightCode = array();
        foreach ($flights as $flight) {
            $flightCode[] = $flight['validatingAirlineCodes'][0];
        }
        return array_unique($flightCode);
    }




    public function priceMin($flights)
    {
        $min = array();
        foreach ($flights as $flight) {
            $min[] = $flight['price']['grandTotal'];
        }
        $numbers = array_map('floatval', $min);
        return min($numbers);
    }

    public function priceMax($flights)
    {
        $min = array();
        foreach ($flights as $flight) {
            $min[] = $flight['price']['grandTotal'];
        }
        $numbers = array_map('floatval', $min);
        return max($numbers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'routes' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'adult' => 'required',
            'children' => 'required',
            'infant' => 'required',
            'trip_type' => 'required',
            'uri' => 'required',
        ]);
        $routes = $validatedData['routes'];
        $data['amount'] = $validatedData['amount'];
        $data['currency'] = $validatedData['currency'];
        $data['adult'] = $validatedData['adult'];
        $data['children'] = $validatedData['children'];
        $data['infant'] = $validatedData['infant'];
        $data['trip_type'] = $validatedData['trip_type'];
        $data['uri'] = $validatedData['uri'];

        // dd(json_decode($routes));

        return view('booking.index', compact('routes', 'data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
