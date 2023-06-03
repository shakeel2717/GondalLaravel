<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Passenger;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Http\Request;

class ExportDataController extends Controller
{
    public function booking()
    {
        Booking::query()->lazyById(2000, 'id')
            ->each(function ($booking) use (&$rows) {
                $rows[] = $booking->toArray();
            });

        SimpleExcelWriter::streamDownload('booking' . now()->format('D') . '.csv')
            ->noHeaderRow()
            ->addRows($rows);
    }


    public function passenger()
    {
        Passenger::query()->lazyById(2000, 'id')
            ->each(function ($passenger) use (&$rows) {
                $rows[] = $passenger->toArray();
            });

        SimpleExcelWriter::streamDownload('passenger' . now()->format('D') . '.csv')
            ->noHeaderRow()
            ->addRows($rows);
    }
}
