<?php

namespace App\Models\Genba;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenbaGraphics extends Model
{
    use HasFactory;
    protected $table = 'genba_graphics';

    function product()
    {
        return $this->belongsTo(GenbaProducts::class, 'product_id', 'id');
    }
}
