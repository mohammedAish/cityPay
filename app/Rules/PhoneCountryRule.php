<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class PhoneCountryRule implements Rule
{
    protected $phone;
    protected $country_code;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($phone, $country_code = 247)
    {
        // AmountRangeRule('deposit', $this->deposit_agency_id)
        $this->phone        = $phone;
        $this->country_code = $country_code;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->isUsedBefore($value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'رقم الهاتف في هذة الدولة مستخدم من قبل';
    }

    public function isUsedBefore($value)
    {
        $founded = Customer::where('country_code', $this->country_code)
            ->where('phone', $value)->first();
        if ($founded && $founded->phone) {
            return true;
        }

        return false;
    }

}
