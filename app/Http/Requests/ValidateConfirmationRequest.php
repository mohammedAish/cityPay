<?php


namespace App\Http\Requests;

use Illuminate\Support\Str;

class ValidateConfirmationRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['guest_email'] = ['required'];
        $rules['guest_password'] = ['required'];
        $rules['confirmation_method'] = ['required'];
        $rules['verification_code'] = ['required'];

        return $rules;
    }
}
