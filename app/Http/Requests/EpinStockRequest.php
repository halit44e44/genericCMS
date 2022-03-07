<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EpinStockRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'supplier_id'=>'required',
            'price'=>'',
            'stock_count'=>'numeric',
            'available_count'=>'numeric',
            'code'=>'unique:stock_codes',
        ];
    }
}
