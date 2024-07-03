<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $fillable = [
        'title',
        'kategori_id',
        'thumbnail',
    ];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }
}