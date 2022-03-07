<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        $rules= [
            'title'=>'required|unique:suppliers',
            'description'=>'required',
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['title']= 'required|unique:suppliers,id,'.$id;   
        }
        
        return $rules;
    }
}
