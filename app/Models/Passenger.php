<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'type',
        'title',
        'firstname',
        'lastname',
        'nationality',
        'dob_year',
        'dob_month',
        'dob_day',
        'passport',
        'passport_year',
        'passport_month',
        'passport_day',
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
