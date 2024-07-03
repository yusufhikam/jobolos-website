<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';
    use HasFactory;


    protected $fillable = [
        'page_id',
        'name',
    ];

    public function pages()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function subContents()
    {
        return $this->hasMany(SubContent::class, 'content_id', 'id');
    }
}
