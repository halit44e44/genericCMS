<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenbaTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules= [
          //
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        // if($id){
        //     $rules['sku']= 'required|unique:genba_products,id,'.$id;   
        // }
        
        return $rules;
    }
}
