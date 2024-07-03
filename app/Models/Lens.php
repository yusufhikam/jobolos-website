<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lens extends Model
{
    protected $table = 'lenses';
    use HasFactory;

    protected $fillable = [
        'camera_type_id',
        'name',
        'code',
        'harga_per_hari',
    ];

    public function camera_types()
    {
        return $this->belongsTo(CameraType::class, 'camera_type_id', 'id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'lens_id', 'id');
    }
}