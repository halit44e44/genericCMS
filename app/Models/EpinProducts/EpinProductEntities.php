<?php

namespace App\Models\EpinProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpinProductEntities extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'epin_product_entities';
    protected $fillable = [
        'id',
        'epinProduct_id',
        'old_id',
        'title',
        'description',
        'price',
        'status',
        'accounting_code'
    ];
    public function epinProduct(){
        return $this->belongsTo(EpinProduct::class,'epinProduct_id','id');

    }
}
