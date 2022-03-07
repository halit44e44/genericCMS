<?php

namespace App\Models;

use App\Models\Genba\GenbaOrderLogs;
use App\Models\Genba\GenbaProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenbaOrderLogsShred extends Model
{
    use HasFactory;
    protected $table = 'genba_order_logs_shred';


    public function genbaProduct(){
        return $this->belongsTo(GenbaProducts::class,'sku','sku');
    }
    public function genbaOrderLog(){
        return $this->hasOne(GenbaOrderLogs::class,'id','genba_order_logs_id');
    }
}
