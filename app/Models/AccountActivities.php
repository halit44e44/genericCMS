<?php

namespace App\Models;

use App\Models\Companies\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountActivities extends Model
{
    use HasFactory;
    protected $table = 'account_activities';

    public function companies(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function bank(){
        return $this->hasOne(BankDefinition::class,'id','bank_id');
    }
}
