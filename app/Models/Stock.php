<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'stocks';  
    protected $fillable = [
        'supplier_id',
        'price',
        'stock_count',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function stockProductEntity(){
        return $this->hasMany(StockProductEntities::class,'stock_id','id');
    }

}
