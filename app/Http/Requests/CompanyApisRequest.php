<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyApisRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules= [
            'authorization'=>'required',
            'api_name'=>'required',
            'api_key'=>'required',
            'client_id'=>'required',
            'client_key'=>'required',
            
            // 'status'=>true,
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['title']= 'required|unique:companies_apis,id,'.$id;   
        }
        
        return $rules;
    }
}
