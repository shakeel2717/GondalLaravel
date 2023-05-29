<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        $bookings = Booking::get();
        return view('admin.finance.index', compact('users', 'bookings'));
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
            'user_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'type' => 'required|string',
            'sum' => 'required|boolean',
            'pnr' => 'nullable|string|exists:bookings,pnr',
            'description' => 'required|string',
        ]);

        // adding transaction
        $transaction = new Transaction();
        $transaction->user_id = $validatedData['user_id'];
        $transaction->amount = $validatedData['amount'];
        $transaction->type = $validatedData['type'];
        $transaction->sum = $validatedData['sum'];
        $transaction->description = $validatedData['description'];
        $transaction->save();

        return back()->with('success', 'Transaction Added Successfully');
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
