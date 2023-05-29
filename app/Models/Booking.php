<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'pnr',
        'trip_type',
        'status',
        'ticket_status',
        'email',
        'phone',
        'payment_method',
        'last_ticketing_date',
        'amount',
        'agent_margin',
        'remarks',
        'routes',
        'nego',
        'received',
        'admin_buy_price',
        'issued_from',
        'uri',
        'track_price',
        'adults',
        'children',
        'infants',
    ];


    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
