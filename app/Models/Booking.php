<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'concept',
        'location_type',
        'location',
        'tanggal',
        'status_pembayaran',
        'payment_type',
        'total_harga',
    ];

    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function packages()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'booking_id', 'id');
    }
}