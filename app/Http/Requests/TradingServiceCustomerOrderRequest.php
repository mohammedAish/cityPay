<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TradingServiceCustomerOrderRequest extends FormRequest
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
            'trading_agency_id'      => 'required',
            'customer_agency_number' => 'required',
            'customer_agency_email'  => 'required|email',

        ];
    }
}
