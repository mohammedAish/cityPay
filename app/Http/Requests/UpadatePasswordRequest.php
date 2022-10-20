<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpadatePasswordRequest extends FormRequest
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
            'old_password'=>'required',
            'password'   => 'required|string|min:6|confirmed',
        ];
    }
}
