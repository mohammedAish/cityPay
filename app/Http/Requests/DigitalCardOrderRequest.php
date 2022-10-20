<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DigitalCardOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'digital_card_id' => 'required|numeric',
            'qty'             => 'required|numeric|min:1',
//            'package_id'      => 'required|numeric',
        ];
    }
}
