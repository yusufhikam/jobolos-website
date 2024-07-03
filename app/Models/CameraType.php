<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraType extends Model
{
    protected $table = 'camera_types';
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
    ];

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function cameras()
    {
        return $this->hasMany(Camera::class, 'camera_type_id', 'id');
    }

    public function lenses()
    {
        return $this->hasMany(Lens::class, 'camera_type_id', 'id');
    }
}