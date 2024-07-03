<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'booking_id',
        'bukti_pembayaran',
        'status',
    ];
    use HasFactory;


    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
