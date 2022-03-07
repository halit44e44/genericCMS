<?php

namespace App\Models\Genba;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenbaPrice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $tables = 'genba_prices';
    public $timestamps = true; 
    protected $fillable = [
        'id',
        'product_id',
        'regionCode',
        'currencyCode',
        'wsp',
        'srp',
        'isPromotion',
    ];

   


}
