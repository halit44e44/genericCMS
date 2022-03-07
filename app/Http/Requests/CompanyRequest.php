<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules= [
            'title'=>'required',
            'description'=>'required',
            'email'=>'required',
            'isActive'=>'required',
            'limitControl'=>'numeric',
            'accountingCode'=>'string',
            'processLimit'=>'numeric',
            'percentItem'=>'numeric',
            'ballanceItem'=>'numeric',
            'constantPercentItem'=>'boolean',
            'mailItem'=>'boolean',
            'unlimitedItem'=>'boolean',
            'description'=>'string',
            'email'=>'string',
            'authorizationItem'=>'string',
            'apiNameItem'=>'string',
            'apiKeyItem'=>'string',
            'feedbackItem'=>'string',
            'clientIdItem'=>'string',
            'clientKeyItem'=>'string',
            'definedIpItem'=>'string',
            
            // 'status'=>true,
        ];

        $id=($this->get('id'))?$this->get('id'):'';
        
        if($id){
            $rules['title']= 'required';   
        }
        
        return $rules;
    }
}
