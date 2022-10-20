<?php

namespace App\Http\Requests;

use App\Rules\AmountRangeRule;
use App\Rules\MasterKeyRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InternalWithdrawRequest extends FormRequest
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
            'amount'     => ['required', 'numeric', new AmountRangeRule('withdraw', $this->agency_id)],
            'agency_id'  => 'required|numeric|min:1',
            'master_key' => new MasterKeyRule,
        ];
    }
}
