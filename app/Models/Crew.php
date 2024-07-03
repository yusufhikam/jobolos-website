<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    protected $table = 'crews';
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'deskripsi',
    ];
}
