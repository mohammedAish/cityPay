<?php

namespace App\Models;

use App\Models\Traits\StatusTrait;
use App\Models\Traits\WalletModelTrait;
use App\Observers\TransferWithdrawObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Prologue\Alerts\Facades\Alert;

class TransferWithdrawOrder extends BaseModel
{
    use CrudTrait,WalletModelTrait,StatusTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'transfer_withdraw_orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fillable = [
        'amount','currency_id','exchange_price','transfer_fee','customer_id',
        'transfer_type','receiving_mode','transfer_agency_country_id',
        'transferred_amount','fee_percent',
        'current_status','status_note',
        'status_changed_date','detail_statement','admin_id','img_path','reference_id_type',
        "receiver_acc_number","receiver_name","receiver_phone","receiver_email","receiver_address","receiver_other_info"
    ];

    // protected $hidden = [];
    public $casts = [
        'status_changed_date' => 'datetime',
    ];
    protected $attributes = [
        'currency_id'             => 1,
        'transferred_currency_id' => 1,
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot(){
        parent::boot();
        TransferWithdrawOrder::observe(TransferWithdrawObserver::class);
    }

    public function save(array $options = []){
        if (isFromAdminPanel()) {
            //if updating
            if (!empty($this->id)) {
                $input = \Illuminate\Support\Facades\Request::all();
                if ($this->checkIsEqualOriginal($this->id,
                    TransferWithdrawOrder::class,'confirmed')
                    //     && \Illuminate\Support\Facades\Request::input('current_status') != 'confirmed'
                ) {
                    Alert::error('لا يمكن تعديل العملية بعد اتمامها')->flash();
                    $this->not_updated = true;

                    return redirect()->back()->withInput();
                }
                if (in_array($input['current_status'],['rejected','confirmed'])
                    && empty($input['detail_statement'])) {
                    Alert::error('لا يمكن ترك حقل ملاحظات الادمن فارغ')->flash();
                    $this->not_updated = true;

                    return redirect()->back()->withInput();
                }

                if ($input['current_status'] == 'confirmed'
                    && (empty($input['amount']) || $input['amount'] <= 0
                        || empty($input['transferred_amount']) || $input['transferred_amount'] <= 0
                    )
                ) {
                    Alert::error('لا يمكن أن تكون حقول المبلغ فارغة او تساوي صفر')->flash();
                    $this->not_updated = true;

                    return redirect()->back()->withInput();
                }
                if (!$this->checkTransferAmounts($input)) {
                    Alert::error('لا يمكن أن يكون المبلغ المحول اكبر من المبلغ المسحوب')->flash();
                    $this->not_updated = true;

                    return redirect()->back()->withInput();
                }

                $this->admin_id            = auth()->id();
                $this->status_changed_date = now()->toDateTimeString();

                //perform saving
                try {
                    \DB::beginTransaction();
                    $saved = parent::save($options);
                    \DB::commit();

                    return $saved;
                } catch (\Throwable $ex) {
                    \DB::rollBack();
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
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function agencyCountry(){
        return $this->belongsTo(ReceivingAgenciesCountry::class,
            'transfer_agency_country_id',"id")->with('country');
    }

    public function currency(){
        return $this->belongsTo(Currency::class,"currency_id","id");
    }

    /**
     * عندما يتم معالجةالعملية تتسجل عملية المعالجة تلقائيا
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function DepositWithdrawProcess(){
        return $this->morphOne(DepositWithdrawProcess::class,'processable');
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
