<?php

namespace App\Console\Commands\customer;

use App\Mail\DepartureNotificaiton;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TodayFlightDeparture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:today-flight-departure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Customer Email if the departure date is today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::where('ticket_status', 'issued')->get();
        foreach ($bookings as $booking) {
            $routes = json_decode($booking->routes);
            $departureDate = now()->parse($routes->itineraries[0]->segments[0]->departure->at)->diffInHours();
            if ($departureDate < 72) {
                Mail::to($booking->email)->send(new DepartureNotificaiton($booking));
            }
        }
    }
}
