<?php

namespace App\Models\Genba;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class GenbaProducts extends Model
{
    
    use HasFactory;
    //use HasTranslations;
    use SoftDeletes;
    protected $table = 'genba_products'; 
    public $timestamps = true; 

    protected $fillable = [
        'id',
        'productID',
        'sku',
        'regionCode',
        'name',
        'isBundle',
        'status',
        'details_sync',
        'price_sync',
        'tr_price',
        'en_price',
        'eur_price',

    ];
   public function languages()
    {
        return $this->hasMany(GenbaLanguages::class,'product_id','id');
    }
   public function genbaGraphics()
    {
        return $this->hasMany(GenbaGraphics::class,'product_id','id');
    }
    public function genbaPrice()
    {
        return $this->hasMany(GenbaPrice::class,'product_id','id');
    }
    public function genbaGameLanguage()
    {
        return $this->hasOne(GenbaGameLanguage::class,'product_id','id');
    }
    public function genbaInstruction()
    {
        return $this->hasMany(GenbaInstructions::class,'product_id','id');
    }
    public function genbaAgeRestriction(){
        return $this->belongsTo(GenbaAgeRestriction::class,'id','product_id');
    }

    public function genbaVideo(){
        return $this->hasMany(GenbaVideoURLs::class,'product_id','id');
    }

    public function restriction(){
        return $this->hasOne(GenbaRestrictions::class,'product_id','id');
    }
    
}
