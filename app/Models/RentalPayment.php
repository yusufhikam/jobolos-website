<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalPayment extends Model
{
    protected $table = 'rental_payments';
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    public function rentals()
    {
        return $this->belongsTo(Rental::class, 'rental_id', 'id');
    }
}