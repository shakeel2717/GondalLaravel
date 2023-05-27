<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Passenger;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'firstname' => 'required',
            'lastname' => 'required',
            'nationality' => 'required',
            'dob_month' => 'required',
            'dob_day' => 'required',
            'dob_year' => 'required',
            'passport' => 'required',
            'passport_day' => 'required',
            'passport_year' => 'required',
            'passport_month' => 'required',
        ]);


        // adding new Booking
        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->routes = $validatedData['routes'];
        $booking->pnr = $this->quickRandom(6);
        $booking->last_ticketing_date = now();
        $booking->amount = 999;
        $booking->save();

        // adding passenger
        $passenger = new Passenger();
        $passenger->booking_id = $booking->id;
        $passenger->type = 'adult';
        $passenger->firstname = $validatedData['firstname'];
        $passenger->lastname = $validatedData['lastname'];
        $passenger->nationality = $validatedData['nationality'];
        $passenger->dob_month = $validatedData['dob_month'];
        $passenger->dob_day = $validatedData['dob_day'];
        $passenger->dob_year = $validatedData['dob_year'];
        $passenger->passport = $validatedData['passport'];
        $passenger->passport_day = $validatedData['passport_day'];
        $passenger->passport_year = $validatedData['passport_year'];
        $passenger->passport_month = $validatedData['passport_month'];
        $passenger->save();

        return redirect()->route('index')->with('success', 'Success');
    }


    private static function quickRandom($length = 16)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
