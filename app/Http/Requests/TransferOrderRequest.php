<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferOrderRequest extends FormRequest
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
            'country_id'          => 'required|numeric|min:1',
            'receiving_mode'      => ['required',Rule::in(['cash','wallet'])],
            'transfer_agency_id'  => 'required|numeric|min:1',
            'amount'              => 'required|numeric',
//            'currency_id'        => 'required|numeric|min:1',
            'receiver_acc_number' => 'required',
           // 'receiver_name'       => 'required',  //not required
           // 'receiver_phone'      => 'required', //not required

        ];
    }
}
