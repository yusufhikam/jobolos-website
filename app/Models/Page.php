<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    use HasFactory;

    protected $fillable = ['name'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'page_id', 'id');
    }
}
