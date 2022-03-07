<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangePrices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'exchange_prices';

    protected $fillable = [
      'currency',
       'currency_price', 
       'currency_code', 
       'isActive'
    ];
}
