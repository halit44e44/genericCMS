<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenbaProductRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules= [
            'productID'=>'required',
            'sku'=>'required',
            'regionCode'=>'required',
            'name'=>'required',
            'status'=>'required',
            'tr_price'=>'required',
            'en_price'=>'required',
            'eur_price'=>'required'

        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['sku']= 'required|unique:genba_products,id,'.$id;   
        }
        
        return $rules;
    }
}
