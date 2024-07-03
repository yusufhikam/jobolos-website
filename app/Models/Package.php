<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $table = 'packages';
    use HasFactory;
    protected $fillable = [
        'name',
        'deskripsi',
        'image',
        'harga',
    ];
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'package_id', 'id');
    }
}