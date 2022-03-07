<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenbaPriceRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules= [
            'productID'=>'required',
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['sku']= 'required|unique:genba_prices,id,'.$id;   
        }
        
        return $rules;
    }
}
