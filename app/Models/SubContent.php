<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContent extends Model
{
    protected $table = 'sub_contents';
    use HasFactory;

    protected $fillable = [
        'content_id',
        'value',
    ];

    public function contents()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}
