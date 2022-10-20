<?php

namespace App\Models;

use App\Models\Traits\DepositWithdrawTrait;
use App\Models\Traits\StatusTrait;
use App\Models\Traits\WalletModelTrait;
use App\Observers\DepositOrderObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Prologue\Alerts\Facades\Alert;

class DepositOrder extends BaseModel
{
    use CrudTrait, WalletModelTrait,StatusTrait,Notifiable,DepositWithdrawTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'deposit_orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'deposit_date', 'op_type', 'order_type', 'amount', 'currency_id', 'exchange_price', 'customer_id',
        'deposit_type',
        'deposit_agency_country_id', 'current_status', 'status_note', 'status_changed_date', 'confirmed_code',
        'detail_statement', 'admin_id', 'img_path', 'reference_id', 'final_amount', 'op_code','client_amount','cl_amount_curr_id',
    ];
    // protected $hidden = [];
    protected $dates = [
        'deposit_date'        => 'datetime',
        'status_changed_date' => 'datetime',
    ];
    public $casts = [
        'deposit_date'        => 'datetime',
        'status_changed_date' => 'datetime',
    ];

    /*public $with=['agency'];*/
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot() {
        parent::boot();

        DepositOrder::observe(DepositOrderObserver::class);
    }

    public function save(array $options = []) {
        if (isFromAdminPanel()) {
            //if updating
            if (!empty($this->id)) {
                $input = \Illuminate\Support\Facades\Request::all();
                if($this->getOriginal('current_status')=='confirmed'){
                    Alert::error('لا يمكن تعديل العملية بعد قبولها')->flash();
                    $this->not_updated = true;
                    return redirect()->back()->withInput();
                }


                if (in_array($input['current_status'],
                        ['rejected', 'confirmed']) && empty($input['detail_statement'])) {
                    Alert::error('لا يمكن ترك حقل ملاحظات الادمن فارغ')->flash();
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



}
