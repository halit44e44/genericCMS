<?php

namespace App\Models\EpinProducts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpinProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'epin_products';


    protected $fillable = [
        'id',
        'old_id', 
        'title',
        'description',
        'imgUrl',
        'status'
    ];
}
