<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerFinanceAccountRequest2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agency_id'                  => ['required', 'numeric'],
//            'recipient_name_local'       => 'required_if:deposit_type,1',
//            'phone_number_local'         => 'required_if:deposit_type,1',
//            'address_local'              => 'required_if:deposit_type,1',
//            'soft_bank_local'            => 'required_if:deposit_type,1',
            'deposit_type'               => 'required',
            'recipient_name_transfer'    => 'required_if:deposit_type,1',
            'phone_number_transfer'      => 'required_if:deposit_type,1',
            'address_transfer'           => 'required_if:deposit_type,1',
            'wallet_number_banking'      => 'required_if:deposit_type,2',
            'wallet_number_crypto'       => 'required_if:deposit_type,4',
            'customer_agency_acc_name'   => 'required_if:deposit_type,12',
            'customer_agency_acc_number' => 'required_if:deposit_type,12',
            'address_international'      => 'required_if:deposit_type,12',
            'soft_bank_international'    => 'required_if:deposit_type,12',
            //phone_number, address, 
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'deposit_type.required'                  => cp('system_field_is_required'),
            'agency_id.required'                     => cp('agency_id_field_is_required'),
            'recipient_name_transfer.required_if'    => cp('recipient_nameـfield_is_required'),
            'phone_number_transfer.required_if'      => cp('phone_number_field_is_required'),
            'address_transfer.required_if'           => cp('address_field_is_required'),
            'wallet_number_banking.required_if'      => cp('wallet_number_field_is_required'),
            'wallet_number_crypto.required_if'       => cp('wallet_number_field_is_required'),
            'customer_agency_acc_name.required_if'   => cp('account_name_field_is_required'),
            'customer_agency_acc_number.required_if' => cp('account_number_field_is_required'),
            'address_international.required_if'      => cp('address_field_is_required'),
            'soft_bank_international.required_if'    => cp('soft_bank_field_is_required'),
        ];
    }
}
