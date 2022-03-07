<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockCode extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'stock_codes';  
    
    protected $fillable = [
        'stock_id',
        'codes',
    ];

}
