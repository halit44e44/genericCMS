<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules= [
            'title'=>'required|unique:categories',
            'description'=>'required',
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['title']= 'required|unique:categories,id,'.$id;   
        }
        
        return $rules;
    }
}
