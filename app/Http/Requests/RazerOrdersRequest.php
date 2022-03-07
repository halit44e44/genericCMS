<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RazerOrdersRequest extends FormRequest
{
 
    public function authorize()
    {
        return false;
    }

   
    public function rules()
    {
        return [
            //
        ];
    }
}
