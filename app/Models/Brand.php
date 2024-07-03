<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function cameraTypes()
    {
        return $this->hasMany(CameraType::class, 'brand_id', 'id');
    }
}