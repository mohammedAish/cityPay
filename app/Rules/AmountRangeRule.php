<?php

namespace App\Rules;

use App\Models\DepositAgency;
use Illuminate\Contracts\Validation\Rule;

class AmountRangeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $rangType;
    protected $agency_id;

    public function __construct($rangType = 'deposit', $agency_id = 1)
    {
        $this->rangType  = $rangType;
        $this->agency_id = $agency_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function message()
    {
        return trans('validation.between.numeric');
    }

    public function passes($attribute, $value)
    {
        if (!$this->isValueInRange($value)) {
            return false;
        }

        return true;
    }

    public function isValueInRange($value)
    {
        $agencyInfo = DepositAgency::findOrFail($this->agency_id);

        if ($this->rangType == 'deposit') {
            if ($value >= $agencyInfo->min_deposit_amount && $value <= $agencyInfo->max_deposit_amount) {
                return true;
            }
        } elseif ($this->rangType == 'withdraw') {
            if ($value >= $agencyInfo->min_withdraw_amount && $value <= $agencyInfo->max_withdraw_amount) {
                return true;
            }
        }

        return false;
    }


}
