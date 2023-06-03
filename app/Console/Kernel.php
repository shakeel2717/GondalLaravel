<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('track:price')
            ->withoutOverlapping()
            ->hourly()
            ->runsInMaintenanceMode();


        $schedule->command('check:payment-due')
            ->withoutOverlapping()
            ->daily()
            ->runsInMaintenanceMode();


        $schedule->command('check:admin-last-ticketing-alert')
            ->withoutOverlapping()
            ->hourly()
            ->runsInMaintenanceMode();


        $schedule->command('check:today-flight-departure')
            ->withoutOverlapping()
            ->daily()
            ->runsInMaintenanceMode();


        $schedule->command('check:collector-today-departures')
            ->withoutOverlapping()
            ->daily()
            ->runsInMaintenanceMode();


        $schedule->command('check:customer-dob')
            ->withoutOverlapping()
            ->daily()
            ->runsInMaintenanceMode();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
