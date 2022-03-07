<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'companies';
    protected $fillable = [
         'title',
         'description', 
         'accountingCode',
         'isActive',
         'maxTransactionLimit',
         'percentage',
         'limitControl',
         'ballance',
         'constantPercentage',
         'sms',
         'mail',
         'unlimited',
         'preOrders',
        //  'status',
      ];
      function companyApi()
    {
        return $this->hasOne(CompanyApi::class,'company_id','id');
    }
    function companyIp() {
      return $this->hasMany(CompanyApi::class,'company_id','id');
    }
}
