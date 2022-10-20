<?php


namespace App\Http\Controllers\Traits;


use App\Models\CustomerCourse;

trait CourseTrait
{
    static function makeCourseAsRead($customer_id, $course_id, $subject_id) {

        $customerCourse = CustomerCourse::
        whereCustomerId($customer_id)
            ->where('course_id', $course_id)->first();
        if (!$customerCourse) {
            return null;
        }
        $customerCourse->last_subject_id = $subject_id;
        $completed_subjects              = json_decode($customerCourse->completed_subjects, true);
        if (!in_array($subject_id, $completed_subjects)) {
            array_push($completed_subjects, $subject_id);
        }
        $completed_subjects                 = json_encode($completed_subjects);
        $customerCourse->completed_subjects = $completed_subjects;
        $customerCourse->save();

        return $customerCourse;
    }

}
