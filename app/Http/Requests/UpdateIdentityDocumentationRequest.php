<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIdentityDocumentationRequest extends FormRequest
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
            'document_type'   => 'required',
            'document_file'   => 'required|file|max:50000|mimes:pdf,png,jpg,svg',
            'manager_address' => 'required|file|max:50000|mimes:pdf,png,jpg,svg',
            'document_id'     => 'required',
        ];
    }
}
