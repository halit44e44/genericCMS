<?php

namespace App\Models\Genba;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenbaLanguages extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true; 
    protected $table = "genba_languages";
    protected $fillable = [
        'id',
        'product_id',
        'languageName',
        'localisedName',
        'localisedDescription',
        'localisedKeyFeatures',
        'legalText',   

    ];
    public function genbaProducts() {
        return $this->belognsTo(GenbaProducts::class,'product_id','id');
    }
}
