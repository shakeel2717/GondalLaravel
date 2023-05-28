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
            'adult_count' => 'required|integer',
            'children_count' => 'required|integer',
            'infant_count' => 'required|integer',
            'payment_gateway' => 'required|string',
            'trip_type' => 'required|string',
            'marginAmount' => 'required|numeric',
            'pureAmount' => 'required|numeric',
            'negoAmount' => 'required|numeric',
            'receivedAmount' => 'required|numeric',
            'lastTicketingDate' => 'required',
            'ticket_status' => 'required|string',
        ]);
        // dd($request);
        $routes = json_decode($validatedData['routes']);
        $lastTicketingDate = now()->parse($routes->lastTicketingDate)->format('Y-m-d H:i:s');

        // adding new Booking
        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->routes = $validatedData['routes'];
        $booking->payment_method = $validatedData['payment_gateway'];
        $booking->trip_type = $validatedData['trip_type'];
        $booking->pnr = $this->quickRandom(6);
        $booking->status = $validatedData['ticket_status'];
        $booking->last_ticketing_date = $lastTicketingDate;
        $booking->agent_margin = $validatedData['marginAmount'];
        $booking->amount = $validatedData['pureAmount'];
        $booking->nego = $validatedData['negoAmount'];
        $booking->received = $validatedData['receivedAmount'];
        $booking->admin_buy_price = $validatedData['pureAmount'];
        $booking->save();

        for ($i = 1; $i < $validatedData['adult_count'] + 1; $i++) {
            info('new adult');
            // adding passenger
            $passenger = new Passenger();
            $passenger->booking_id =  $booking->id;
            $passenger->type = 'adult';
            $passenger->title = $request->get('title_adult_' . $i);
            $passenger->firstname = $request->get('firstname_adult_' . $i);
            $passenger->lastname = $request->get('lastname_adult_' . $i);
            $passenger->nationality = $request->get('nationality_adult_' . $i);
            $passenger->dob_month = $request->get('dob_month_adult_' . $i);
            $passenger->dob_day = $request->get('dob_day_adult_' . $i);
            $passenger->dob_year = $request->get('dob_year_adult_' . $i);
            $passenger->passport = $request->get('passport_adult_' . $i);
            $passenger->passport_day = $request->get('passport_day_adult_' . $i);
            $passenger->passport_year = $request->get('passport_year_adult_' . $i);
            $passenger->passport_month = $request->get('passport_month_adult_' . $i);
            $passenger->save();
        }

        for ($i = 1; $i < $validatedData['children_count'] + 1; $i++) {
            info('new children');
            // adding passenger
            $passenger = new Passenger();
            $passenger->booking_id =  $booking->id;
            $passenger->type = 'children';
            $passenger->title = $request->get('title_children_' . $i);
            $passenger->firstname = $request->get('firstname_children_' . $i);
            $passenger->lastname = $request->get('lastname_children_' . $i);
            $passenger->nationality = $request->get('nationality_children_' . $i);
            $passenger->dob_month = $request->get('dob_month_children_' . $i);
            $passenger->dob_day = $request->get('dob_day_children_' . $i);
            $passenger->dob_year = $request->get('dob_year_children_' . $i);
            $passenger->passport = $request->get('passport_children_' . $i);
            $passenger->passport_day = $request->get('passport_day_children_' . $i);
            $passenger->passport_year = $request->get('passport_year_children_' . $i);
            $passenger->passport_month = $request->get('passport_month_children_' . $i);
            $passenger->save();
        }

        for ($i = 1; $i < $validatedData['infant_count'] + 1; $i++) {
            info('new infant');
            // adding passenger
            $passenger = new Passenger();
            $passenger->booking_id =  $booking->id;
            $passenger->type = 'infant';
            $passenger->title = $request->get('title_infant_' . $i);
            $passenger->firstname = $request->get('firstname_infant_' . $i);
            $passenger->lastname = $request->get('lastname_infant_' . $i);
            $passenger->nationality = $request->get('nationality_infant_' . $i);
            $passenger->dob_month = $request->get('dob_month_infant_' . $i);
            $passenger->dob_day = $request->get('dob_day_infant_' . $i);
            $passenger->dob_year = $request->get('dob_year_infant_' . $i);
            $passenger->passport = $request->get('passport_infant_' . $i);
            $passenger->passport_day = $request->get('passport_day_infant_' . $i);
            $passenger->passport_year = $request->get('passport_year_infant_' . $i);
            $passenger->passport_month = $request->get('passport_month_infant_' . $i);
            $passenger->save();
        }

        return redirect()->route('flight.booking.show', ['booking' => $booking->id]);
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
        $flightData = json_decode($booking->routes);
        return view('booking.show', compact('booking', 'flightData'));
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
