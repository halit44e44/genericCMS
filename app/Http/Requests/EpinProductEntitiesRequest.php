<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpinProductEntitiesRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules= [
            
            'title'=>'required',
            'description'=>'',
            'price'=>'required|numeric',
            'accounting_code'=>'required',

        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['title']= 'required';   
        }
        
        return $rules;
    }
}
