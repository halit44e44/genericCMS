<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccounts extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'bank_accounts';
    protected $fillable = [
        'bank_id',
        'branch_code',
        'account_code',
        'iban_no',
        'account_owner',
        'isActive',
        // 'status',
        'description'
    ];
    function bankDefinition()
    {
        return $this->hasOne(BankDefinition::class,'id','bank_id');
    }
}
