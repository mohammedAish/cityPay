<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use mysql_xdevapi\Exception;

class CourseTraining extends BaseModel
{
    use CrudTrait, HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'courses_trainings';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public $translatable = ['name', 'description', 'requirements', 'what_learn',/* 'img_path'*/];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function save(array $options = []) {
        $is_new = false;
        if (!$this->id) {
            $is_new = true;
        }
        $saved = parent::save($options);
        if ($is_new) {
            $courseId = $this->id;
            CoursePart::create(
                [
                    'course_id' => $courseId,
                    'name'      => 'course_'.$courseId.'_part1',
                ]
            );
        }
    }

    public function delete() {
        $id = $this->id;
        try {
            \DB::beginTransaction();
            CoursePart::where('course_id', $id)->delete();
            $deleted = parent::delete();
            \DB::commit();
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
            \DB::rollBack();
        }

        return $deleted;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category() {
        return $this->belongsTo(CourseCategory::class,
            'course_category_id', 'id');
    }


    /**
     * @return MorphMany
     */
    public function comments(): MorphMany {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseSubjects() {
        return $this->hasMany(CourseSubject::class, 'course_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseParts() {
        return $this->hasMany(CoursePart::class, 'course_id', 'id');
    }

    public function courseExercises() {
        return $this->hasMany(CourseExercise::class, 'course_id', 'id');
    }

    /**
     * @belongs to teacher
     *
     */
    public function teacher() {
        return $this->belongsTo(TeacherDetail::class, "teacher_id", 'id');
    }

    /**
     * currency belongs to
     */
    public function currency() {
        return $this->belongsTo(Currency::class, "currency_id", "id");
    }

    /**
     * @return BelongsToMany
     */
    public function customers() {
        return $this->belongsToMany(Customer::class, "customers_courses"
            , "course_id", "customer_id");
    }



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model|object
     * static relation
     */
    public function service() {
        return Service::where('id', 5)->first();
        //  return $this->belongsTo(Service::class,)
    }

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
    public function setImgPathAttribute($value) {
        $attribute_name = "img_path";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/storage/courses";
        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.png';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path           = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

            return $this->attributes['img_path'];
        }
    }

    public function subjectsBtn($xPanel = false) {
        $url = admin_url('coursetraining/'.$this->id.'/coursesubject');

        $msg     = trans('lang.course_subjects', ['course' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';

        $out = '';
        $out .= '<div class="btn-group">';
        $out .= '<a class="btn btn-sm btn-link pr-0" href="'.$url.'"'.$toolTip.'>';
        $out .= ' <i class="la la-edit"></i>';
        $out .= mb_ucfirst(trans('lang.course_subjects'));
        $out .= '</a></div>';

        return $out;
    }

    public function partsBtn($xPanel = false) {
        $url = admin_url('coursetraining/'.$this->id.'/courseParts');

        $msg     = trans('lang.part_course', ['course' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';

        $out = '';

        $out .= '<div class="btn-group">';
        $out .= '<a class="btn btn-sm  btn-link pr-0" href="'.$url.'"'.$toolTip.'>';
        $out .= ' <i class="la la-edit"></i>';
        $out .= mb_ucfirst(trans('lang.part_course'));
        $out .= '</a></div>';

        return $out;
    }

    public function exercisesBtn($xPanel = false) {
        $url = admin_url('coursetraining/'.$this->id.'/courseexercise');

        $msg     = trans('lang.course_exercise', ['course' => $this->name]);
        $toolTip = ' data-toggle="tooltip" title="'.$msg.'"';

        $out = '';
        $out .= '<div class="btn-group">';
        $out .= '<a class="btn btn-sm btn-link pr-0" href="'.$url.'"'.$toolTip.'>';
        $out .= ' <i class="la la-edit"></i>';
        $out .= mb_ucfirst(trans('lang.course_exercise'));
        $out .= '</a></div>';

        return $out;
    }

}
