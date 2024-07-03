<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalInvoice extends Model
{
    protected $table = 'rental_invoices';
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'invoice_name',
    ];

    public function rentals()
    {
        return $this->belongsTo(Rental::class, 'rental_id', 'id');
    }
}