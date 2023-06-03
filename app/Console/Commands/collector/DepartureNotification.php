<?php

namespace App\Console\Commands\collector;

use App\Mail\TodayDepartureFlights;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DepartureNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:collector-today-departures';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking if any Ticket will be departure today.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::where('ticket_status', 'issued')->get();
        $pnrs = [];
        foreach ($bookings as $booking) {
            $routes = json_decode($booking->routes);
            $departureDate = now()->parse($routes->itineraries[0]->segments[0]->departure->at)->diffInHours();
            if ($departureDate < 24) {
                $pnrs[] = [
                    'pnr' => $booking->pnr,
                    'time' => $routes->itineraries[0]->segments[0]->departure->at,
                ];
            }
        }
        if (count($pnrs) > 0) {
            Mail::to($booking->email)->send(new TodayDepartureFlights($pnrs));
        }
    }
}
