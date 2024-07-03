<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_name',
        'booking_id',
    ];
    use HasFactory;

    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
