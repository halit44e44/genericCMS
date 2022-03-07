<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

  
    public function rules()
    {
        $rules= [
            'name'=>'required|unique:platforms',
          
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['name']= 'required|unique:platforms,id,'.$id;   
        }
        
        return $rules;
    }
}
