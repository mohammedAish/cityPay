<?php

namespace App\Models;

use App\IdentityDocumentation;
use App\Notifications\EmailCustomerVerfication;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject, Wallet, WalletFloat,MustVerifyEmail //we did it maneual
 {
    use   CrudTrait, Notifiable, HasRoles, HasWalletFloat;

    protected $guard = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'phone', 'phone2', 'gender', 'birth_date', 'city_id', 'address', 'address_2',
        'account_number', 'customer_type', 'active', 'whatsapp_acc', 'facebook_acc', 'country_code', 'img_profile',
        'wallet_code','email_token','referrer_id','reference_id'
        //'remember_token','email_verified_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $attributes = [
        'customer_type' => 'customer',
    ];


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customers';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $appends = ['name'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getNameAttribute() {
        $lastName = isset($this->attributes['last_name']) ? ' '.$this->attributes['last_name'] : '';

        return isset($this->attributes['first_name']) ? $this->attributes['first_name'].$lastName : $lastName;
    }

    public function getWalletCodeSymbolAttribute() {
        $wallet_code = null;
        if (isset($this->attributes['wallet_code'])) {
            $wallet_code = $this->attributes['wallet_code'];
            // $wallet_code = $wallet_code ?? $this->wallet->id;//why this
            if ($wallet_code < 10) {
                $wallet_code = 'T0000'.$wallet_code;
            } elseif ($wallet_code < 100) {
                $wallet_code = 'T000'.$wallet_code;
            } elseif ($wallet_code < 1000) {
                $wallet_code = 'T00'.$wallet_code;
            } elseif ($wallet_code < 10000) {
                $wallet_code = 'T0'.$wallet_code;
            } else// ($wallet_code >= 10000)
            {
                $wallet_code = 'T'.$wallet_code;
            }
        }

        return $wallet_code;

    }

    public function getBalanceFloatHtml() {
        if (isset($this->BalanceFloat) and !empty($this->BalanceFloat)) {
            return $this->BalanceFloat.' $';
        } else {
            return null;
        }
    }

    public function getDepositsCountAttribute() {
        return $this->deposits->count() > 0 ? $this->deposits->count() : 0;
    }

    public function getWithdrawsCountAttribute() {
        return $this->withdrawals->count() > 0 ? $this->withdrawals->count() : 0;
    }

    public function getFullAddressAttribute() {
        $address = isset($this->address) and !empty($this->address) ? $this->address : '';
        $address .= isset($this->address2) and !empty($this->address2) ? $this->address2 : $address;

        return $address;
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailCustomerVerfication($this));
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses() {
        return $this->belongsToMany(CourseTraining::class, "customers_courses"
            , "customer_id", "course_id");
    }

    /*  public function coursSubjects(){
         // return $this->hasManyThrough(CourseSubject::class,CourseTraining::class,);
      }*/

    public function consultants() {
        return $this->belongsToMany(Consultant::class, "customer_consultants_orders"
            , "customer_id", "consultant_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function comments() {
        return $this->morphTo(Comment::class, "customer_id", "id");
    }

    /**
     * maybe a customer become teacher
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher() {
        return $this->hasOne(TeacherDetail::class, "customer_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function badge() {
        return $this->belongsTo(Badge::class, 'badge_id', 'id');
    }


    public function financeAccounts() {
        return $this->hasMany(CustomerFinanceAccount::class, 'customer_id', 'id');
    }

    public function country() {
        return $this->belongsTo(Country::class, "country_code", 'id');
    }


    public function broadcasting() {
        return $this->belongsToMany(LiveBroadcasting::class, "customer_live_broadcasting",
            "customer_id", "live_broadcasting_id");
    }

    public function deposits() {
        return $this->hasMany(DepositOrder::class, 'customer_id', 'id')
            ->where('current_status', 'confirmed')
            ->where('op_type', 'deposit');
    }

    public function withdrawals() {
        return $this->hasMany(DepositOrder::class, 'customer_id', 'id')
            ->where('current_status', 'confirmed')
            ->where('op_type', 'withdraw');
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
    /**
     * @inheritDoc
     */
    public function getJWTIdentifier() {
        return $this->getKey();
        // TODO: Implement getJWTIdentifier() method.
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims() {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }


    public function document()
    {
        return $this->hasMany(IdentityDocumentation::class, 'customer_id', 'id')->latest()->first();
    }
}
