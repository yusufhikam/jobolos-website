<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $table = 'cameras';
    use HasFactory;

    protected $fillable = [
        'camera_type_id',
        'name',
        'code',
        'harga_per_hari',
        'image',
        'thumbnail',
        'deskripsi',
    ];


    public function rentals()
    {
        return $this->hasMany(Rental::class, 'camera_id', 'id');
    }

    public function camera_types()
    {
        return $this->belongsTo(CameraType::class, 'camera_type_id', 'id');
    }
}