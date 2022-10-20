<?php

namespace App\Models;


class CourseSubjectAttachment extends BaseModel
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */

    protected $table = 'subject_attachments';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseSubject(){
        return $this->belongsTo(CourseSubject::class,'subject_id',"id");
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
