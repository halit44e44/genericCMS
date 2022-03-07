<?php

namespace App\Repositories;

use App\Models\Genba\GenbaMetaData;

use Orkhanahmadov\EloquentRepository\EloquentRepository;

class GenbaMetaDataRepository extends EloquentRepository
{
    protected $entity = GenbaMetaData::class;

    function getMetaData($id){

        $genbaPrice = GenbaMetaData::where('product_id',$id)->get();
        return $genbaPrice;
    }
   


  
}
