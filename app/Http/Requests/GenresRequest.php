<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenresRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules= [
            'name'=>'required|unique:genres',
          
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['name']= 'required|unique:genres,id,'.$id;   
        }
        
        return $rules;
    }
}
