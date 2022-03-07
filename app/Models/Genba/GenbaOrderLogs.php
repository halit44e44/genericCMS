<?php

namespace App\Models\Genba;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenbaOrderLogs extends Model
{
    use HasFactory;
    protected $table = 'genba_order_logs';

    public function genbaClientToken(){
        return $this->hasOne(GenbaClientToken::class,'one_time_token','one_time_token');
    }
  
}

