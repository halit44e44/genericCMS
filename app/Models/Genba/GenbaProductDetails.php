<?php

namespace App\Models\Genba;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenbaProductDetails extends Model
{
    use HasFactory;

    function platform()
    {
        return $this->belongsTo(Platform::class,'platform_id','id');
    }
    function developer()
    {
        return $this->hasOne(GenbaDeveloper::class,'id','developer_id');
    }
    function publisher()
    {
        return $this->hasOne(GenbaPublisher::class,'id','publisher_id');
    }
}
