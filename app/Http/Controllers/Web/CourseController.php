<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Requests\CommentRequest;
use App\Models\CourseCategory;
use App\Models\CourseTraining;
use App\Models\TeacherDetail;


class CourseController extends BaseWebController
{
    use CommonTrait;

    public function mainCourses() {
        $courseCategories     = CourseCategory::whereActive(1)->get();
        $courses              = CourseTraining::whereActive(1)->paginate(20);
        $poplar_with_students = $this->getPoplarCourses();
        $mostInCommon         = $this->getMostCoursesByAll();

//        return dd($courseCategories);
        return view('courses.main_courses')
            ->with('courses_categories', $courseCategories)
            ->with('students_poplar', $poplar_with_students)
            ->with('most_in_common', $mostInCommon)
            ->with('courses', $courses);
    }

    public function categoryCourses($cat_id = 0) {
        $courseCategories = CourseCategory::whereActive(1)
            ->whereId($cat_id)->first();
        if (!$courseCategories) {
            abort(404, 'no category courses found');
        }
        $courses = CourseTraining::whereActive(1)
            ->where('course_category_id', $cat_id)
            ->paginate(20);

        return view('courses.category')
            ->with('courses_categories', $courseCategories)
            ->with('courses', $courses);
    }

    /**
     * لعرض بيانات كورس معين
     *
     * @param  int  $course_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function courseInfo($course_id = 0) {
        $courseInfo = CourseTraining:: whereId($course_id)
            ->with('comments')->first();
        if (!$courseInfo) {
            abort(404, 'no course found');
        }

//        return dd($courseInfo->courseSubjects);
        return view('courses.course_details')
//        return view('courses.course-area')
            ->with('course_info', $courseInfo);
    }

    public function courseCheckout($course_id = 0) {

        $courseInfo = CourseTraining::whereId($course_id)
            ->with('comments')->first();
        if (!$courseInfo) {
            abort(404, 'no course found');
        }

        return view('courses.checkout')
//        return view('courses.course-area')
            ->with('course_info', $courseInfo);
    }

    public function searchInCourses($term) {
        $resultSearch = CourseTraining::
        where(function ($query) use ($term) {
            return $query->where('name', 'like', '%'.$term.'%')
                ->orWhere('description', 'like', '%'.$term.'%');
        })->get();
        if (!$resultSearch->count()) {
            $data['msg']  = trans('no result found');
            $data['data'] = [];
        }
        $data['msg']  = trans("you get $resultSearch->count() result ");
        $data['data'] = $resultSearch;

        return view('courses.search')
            ->with('search_result', $data);
    }

    public function courseInstructorInfo($id) {
        $teacher_info   = TeacherDetail::findOrFail($id);
        $teacherCourses = $teacher_info->courses;
        if (!$teacher_info) {
            abort(404, 'no teachers found');
        }

        return view('courses.instructor')
            ->with('instructor_info', $teacher_info)
            ->with('teacher_courses', $teacherCourses);
    }


}
