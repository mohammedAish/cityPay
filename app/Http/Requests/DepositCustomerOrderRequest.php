<?php

namespace App\Http\Requests;

use App\Rules\AmountRangeRule;
use App\Rules\MasterKeyRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepositCustomerOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'amount'            => ['required', 'numeric', new AmountRangeRule('deposit', $this->deposit_agency_id)],
            'currency_id'       => 'required|numeric',
            'deposit_agency_id' => 'required|numeric',
            'master_key'        => new MasterKeyRule,
        ];
    }
}
