<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        $rules= [
            'old_id'=>'',
            'title'=>'required|unique:epin_products',
            'description'=>'',
            'imgUrl'=>'',
            'status'=>'boolean',

        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['title']= 'required';   
        }
        
        return $rules;
    }
}
