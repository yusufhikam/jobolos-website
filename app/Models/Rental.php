<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'rentals';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'camera_id',
        'lens_id',
        'tgl_sewa',
        'tgl_kembali',
        'total_harga',
        'denda',
        'jaminan',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rentalPayments()
    {
        return $this->hasMany(RentalPayment::class, 'rental_id', 'id');
    }

    public function cameras()
    {
        return $this->belongsTo(Camera::class, 'camera_id', 'id');
    }

    public function lenses()
    {
        return $this->belongsTo(Lens::class, 'lens_id', 'id');
    }

    public function rental_invoices()
    {
        return $this->hasMany(RentalInvoice::class, 'rental_id', 'id');
    }
}