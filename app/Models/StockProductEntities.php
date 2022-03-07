<?php

namespace App\Models;

use App\Models\EpinProducts\EpinProductEntities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockProductEntities extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'stock_product_entities';  
    protected $fillable = [
        'stock_id',
        'productEntity_id',
    ];

    public function epinProductEntity()
    {
        return $this->BelongsTo(EpinProductEntities::class,'productEntity_id','id');
    }

}
