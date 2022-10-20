<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentityDocumentationRequest extends FormRequest
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
//            'first_name'      => 'required',
//            'last_name'       => 'required',
            'first_name_en'   => 'required',
            'last_name_en'    => 'required',
            'birthdate'       => 'required',
            'mobile'          => 'required',
//            'email'           => 'required|email',
//            'document_type'   => 'required',
//            'document_file'   => 'required|file|max:50000|mimes:pdf,png,jpg,svg',
//            'manager_address' => 'required|file|max:50000|mimes:pdf,png,jpg,svg',
            'country_id'      => 'required',
            'mobile'          => 'required',
        ];
    }
}
