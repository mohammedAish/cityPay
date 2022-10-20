<?php

namespace App\Models;

use App\Observers\DCardsPurchasesDetailObserver;
use Backpack\CRUD\app\Models\Traits\CrudTrait;


class DCardsPurchasesDetail extends BaseModel //implements Product
{
    // use HasWallet;
    use CrudTrait;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'd_cards_purchases_details';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = [
        'expire_date' => 'date',
    ];
    protected $attributes = [
        'card_status' => 'free',
        'currency_id' => 1,
        //'assigned_type' => 'by_admin',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function boot(){
        parent::boot();
        DCardsPurchasesDetail::observe(DCardsPurchasesDetailObserver::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function digitalCard(){
        return $this->belongsTo(DigitalCard::class,"digital_card_id",'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function digitalCardPurchase(){
        return $this->belongsTo(DigitalCardsPurchase::class,"digital_cards_purchase_id",'id');
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
//    public function canBuy(Customer $customer,int $quantity = 1,bool $force = null):bool{
//        $result = $this->quantity >= $quantity;
//
//        if ($force) {
//            return $result;
//        }
//
//        return $result && !$customer->paid($this);
//    }
//
//    /**
//     * @param  Customer  $customer
//     *
//     * @return float|int
//     */
//    public function getAmountProduct(Customer $customer){
//        /**
//         * @var Wallet $wallet
//         */
//        $wallet = app(WalletService::class)->getWallet($customer);
//
//        return $this->price + $wallet->holder_id;
//    }
//
//    /**
//     * @return array|null
//     */
//    public function getMetaProduct():?array{
//        return null;
//    }
//
//    /**
//     * @return string
//     */
//    public function getUniqueId():string{
//        return $this->getKey();
//    }
//
//    /**
//     * @param  int[]  $walletIds
//     *
//     * @return MorphMany
//     */
//    public function boughtGoods(array $walletIds):MorphMany{
//        return $this
//            ->morphMany(config('wallet.transfer.model',Transfer::class),'to')
//            ->where('status',Transfer::STATUS_PAID)
//            ->where('from_type',config('wallet.wallet.model',Wallet::class))
//            ->whereIn('from_id',$walletIds);
//    }


}
