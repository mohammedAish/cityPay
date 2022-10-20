<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CustomerCourse extends BaseModel
{
    use CrudTrait;//we dont need translation

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'customers_courses';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable =
         ['course_id', 'customer_id', 'joined_date', 'last_subject_id', 'final_degree', 'level_result', 'customer_note'];
    // protected $hidden = [];
    // protected $dates = [];
    public $casts=[
        'joined_date'=>'datetime'
    ];
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
    public function customer(){
        return $this->belongsTo(Customer::class,"customer_id",'id');
    }

    public function course(){
        return $this->belongsTo(CourseTraining::class,"course_id",'id');
    }

    /**
     * سيكون له نقط ولاء لانه اشترى هذا الكورس
     * @return MorphOne
     */
    /**
     * this when the service ordered such pull earnings from net or buy from net
     * @return MorphOne
     */
    public function loyalties():MorphOne{
        return $this->morphOne(CustomersLoyaltyPointsPrice::class,'loyaltyable');
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
