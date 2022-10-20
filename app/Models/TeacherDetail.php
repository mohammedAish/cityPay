<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TeacherDetail extends BaseModel
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'teacher_details';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    public $appends = ['teacher_name'];
    protected $dates = [
        'last_certificate' => 'date',
        'join_date'        => 'date',
    ];
    protected $casts = [
        'last_certificate' => 'date',
        'join_date'        => 'date',
    ];
    public $with = ['customer'];
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
    //يمعنى أنه يمكن ان اي كستمر (طالب ) يكتب رأيه في الاستاذ هذا
    public function comments():MorphMany{
        return $this->morphMany(Comment::class,'commentable');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,"customer_id","id");
    }

    public function courses(){
        return $this->hasMany(CourseTraining::class,'teacher_id','id');
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
    public function getTeacherNameAttribute(){
        return $this->customer->first_name.' '.$this->customer->last_name;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
