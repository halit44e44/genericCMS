<?php

namespace App\Models;

use App\Models\Companies\Company;
use App\Models\EpinProducts\EpinProductEntities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory; 
    protected $table = 'transactions';  
   

    public function companies(){
       return $this->belongsTo(Company::class,'company_id','id');
    }
    public function epinProductEntity(){
        return $this->belongsTo(EpinProductEntities::class,'epinProduct_entity_id','id');
    }
    public function clientInfo(){
        return $this->belongsTo(ClientInfo::class,'client_info_id','id');
    }
}
