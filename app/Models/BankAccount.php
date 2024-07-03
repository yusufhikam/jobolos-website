<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';
    use HasFactory;


    protected $fillable = [
        'name',
        'bank_name',
        'no_rek',
    ];
}
