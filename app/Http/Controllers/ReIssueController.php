<?php

namespace App\Http\Controllers;

use App\Mail\TicketReIssueNotification;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReIssueController extends Controller
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
            'uri' => 'required',
        ]);

        $routes = json_decode($validatedData['routes']);


        $lastTicketingDate = now()->parse($routes->lastTicketingDate)->format('Y-m-d H:i:s');

        $booking = Booking::findOrFail(session('bookingData')->id);
        $booking->user_id = auth()->user()->id;
        $booking->routes = $validatedData['routes'];
        $booking->last_ticketing_date = $lastTicketingDate;
        $booking->amount = $routes->price->grandTotal;
        $booking->nego = $routes->price->grandTotal;
        $booking->admin_buy_price = $routes->price->grandTotal;
        $booking->uri = $validatedData['uri'];
        $booking->save();

        // session()->forget('bookingData');

        if ($booking->email != "") {
            Mail::to($booking->email)->send(new TicketReIssueNotification($booking));
        }

        return redirect()->route('flight.booking.show', ['booking' => $booking->id]);
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
