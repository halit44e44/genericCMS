<?php

namespace App\Models\Genba;

use App\Models\ClientInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenbaClientToken extends Model
{
    use HasFactory;
    protected $table = 'genba_client_tokens';

    public function clientInfo(){
        return $this->hasOne(ClientInfo::class,'id','user_id');
    }
}
