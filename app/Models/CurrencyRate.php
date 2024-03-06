<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    protected $fillable = [
        'valute_id',
        'num_code',
        'char_code',
        'nominal',
        'name',
        'value',
        'date',
    ];
}
