<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];
    use HasFactory;

    public function albums()
    {
        return $this->hasMany(Album::class, 'kategori_id', 'id');
    }
}
