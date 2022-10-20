<?php


namespace App\Http\Requests;

class AuthRequest extends Request //for future
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(){
        // Don't apply this to the Admin Panel
        if (isFromAdminPanel()) {
            return;
        }

        $input = $this->all();

        // login (phone)
        if ($this->filled('login')) {
            $loginField = getLoginField($this->input('login'));
            if ($loginField == 'phone') {
                $input['login'] = phoneFormatInt($this->input('login'),
                    $this->input('country_code',session('country_code')));
            }
        }

        request()->merge($input); // Required!
        $this->merge($input);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $rules = [
            // 'login' => ['required'],
        ];

        // reCAPTCHA
        //	$rules = $this->recaptchaRules($rules);

        return $rules;
    }
}
