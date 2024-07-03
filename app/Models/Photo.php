<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = [
        'name',
        'album_id',
    ];
    use HasFactory;


    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
}
