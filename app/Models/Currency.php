<?php

namespace App\Models;

use Database\Factories\CurrencyFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'short_name',
    'symbol',
])]
class Currency extends Model
{
    /** @use HasFactory<CurrencyFactory> */
    use HasFactory;
}
