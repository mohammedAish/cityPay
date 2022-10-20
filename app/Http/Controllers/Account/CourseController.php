<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CourseTrait;
use App\Models\CourseTraining;
use App\Models\CustomerCourse;
use Illuminate\Http\Request;

class CourseController extends AccountBaseController
{

    use CourseTrait;







    public function getCourseExercises($course_id){
        return response()->json(['status' => true]);
    }


    public function downloadCourseAttachment($course_id){
    }


}
