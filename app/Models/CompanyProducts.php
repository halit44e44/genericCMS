<?php

namespace App\Models;

use App\Models\EpinProducts\EpinProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProducts extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'company_products';
    protected $fillable = [
        'percentage',
        //  'status',
    ];
    // function company()
    // {
    //     return $this->hasOne(company::class, 'company_id', 'id');
    // }
    // function product()
    // {
    //     return $this->hasOne(EpinProduct::class, 'product_id', 'id');
    // }
}
