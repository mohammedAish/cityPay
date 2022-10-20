<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CourseSubject extends BaseModel
{
    use CrudTrait;

    //we dont need translation here

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'course_subjects';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $attributes = [
        //  'part_id' => 2,
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
    /**
     * @return MorphMany
     */
    public function comments(): MorphMany {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course() {
        return $this->belongsTo(CourseTraining::class, "course_id", 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coursePart() {
        return $this->belongsTo(CoursePart::class, "part_id", 'id');

    }


    //todo ZAHER recheck it

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers() {
        return $this->belongsToMany(Customer::class, "customers_courses"
            , "course_id", "customer_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjectAttachments() {
        return $this->hasMany(CourseSubjectAttachment::class, 'subject_id', "id");
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
