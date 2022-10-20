<?php

namespace App\Models;

use App\Observers\DepositOrderObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prologue\Alerts\Facades\Alert;


class WithdrawOrder extends DepositOrder
{
   // protected $with = ['customer'];
    public static function boot() {
        parent::boot();
        WithdrawOrder::observe(DepositOrderObserver::class);
    }

    public function save(array $options = []) {
        if (isFromAdminPanel()) {
            //if updating
            if (!empty($this->id)) {
                $input = \Illuminate\Support\Facades\Request::all();
                if($this->getOriginal('current_status')=='rejected'){
                    Alert::error('لا يمكن تعديل العملية بعد رفضها')->flash();
                    $this->not_updated = true;
                    return redirect()->back()->withInput();
                }
                    if ($input['current_status'] == 'confirmed'
                    && (empty($input['amount']) || $input['amount'] <= 0)) {
                    Alert::error('لا يمكن أن يكون المبلغ اقل او يساوي صفر')->flash();
                    $this->not_updated = true;

                    return redirect()->back()->withInput();
                }


                //perform saving
                try {
                    $saved = parent::save($options);
                    return $saved;
                } catch (\Throwable $ex) {
                    Alert::error($ex->getMessage())->flash();
                    $this->not_updated = true;
                    return redirect()->back()->withInput();
                }
            }
        }

        return parent::save($options);
    }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /*public function financeAccount() {
        return $this->belongsTo(CustomerFinanceAccount::class,
            'customer_finance_account', "customer_agency_acc_number")
            //->where('customer_id', $this->customer_id)
            //->where('agency_id', $this->agency_id)
            ;
    }*/

    public function getFinanceAccountNammeHtml() {
        $acc  = $this->customer_finance_account;
        $name = CustomerFinanceAccount::whereCustomerAgencyAccNumber($acc)
            ->whereCustomerId($this->customer_id)
            ->first('customer_agency_acc_name');

        return $name->customer_agency_acc_name ?? '';

    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
