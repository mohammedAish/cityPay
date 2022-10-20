<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Controllers\Traits\CourseTrait;
use App\Http\Resources\CourseCategoryResource;
use App\Http\Resources\CourseTrainingResource;
use App\Models\CourseCategory;
use App\Models\CourseTraining;
use App\Models\CustomerCourse;
use App\Models\TeacherDetail;

class CourseApiController extends BaseApiController
{
    use CourseTrait,CommonTrait;

    /**
     *  /courses
     * [ارجاع الكورسات المتوفرة بطول 30 عنصر  .]
     * @bodyParam limit  number    required  الطول المراد للقائمة - الافتراضي 30
     * @bodyParam last_id  number    required  أخر ايدي ظهر في القائمة السابقة - الافتراضي 0
     * @group Courses
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $courses                            = CourseTraining::whereActive(1)
            ->limitOrder($this->limit,$this->last_id)
            //->limit($this->limit)->where('id','>',$this->limit)->orderBy('id','asc')
            ->get();
        $poplar_with_students               = $this->getPoplarCourses();
        $mostInCommon                       = $this->getMostCoursesByAll();
        $this->base_data['students_poplar'] = $poplar_with_students;
        $this->base_data['most_in_common']  = $mostInCommon;
        $this->base_data['courses']         = CourseTrainingResource::collection($courses);

        return $this->success_response($this->base_data,tt('you_get_main_courses'));
    }

    /**
     *  /courses/cat/{cat_id?}
     * [ارجاع الكورسات المتوفرة  حسب فئة معينة بطول 30 عنصر  .]
     * @bodyParam cat_id  number    required  الفئةالمراد عرض كورساتها
     * @bodyParam limit  number    required  الطول المراد للقائمة - الافتراضي 30
     * @bodyParam last_id  number    required  أخر ايدي ظهر في القائمة السابقة - الافتراضي 0
     * @group Courses
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryCourses($cat_id = 0){
        $categoryInfo                        = CourseCategory::whereActive(1)
            ->whereId($cat_id)->first();
        $courses                             = CourseTraining::whereActive(1)
            ->where('course_category_id',$cat_id)
            ->limitOrder($this->limit,$this->last_id)->get();
        $this->base_data['category_info']    = new CourseCategoryResource($categoryInfo);
        $this->base_data['category_courses'] = CourseTrainingResource::collection($courses);

        return $this->success_response($this->base_data,tt('you_get_category_courses'));
    }

    /**
     *  /courses/{id?}
     * [ارجاع معلومات كورس معين  .]
     * @bodyParam id  number    required  الكورس المراد عرض بياناته كاملة
     * @group Courses
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseInfo($course_id = 0){
        $courseInfo             = CourseTraining::whereId($course_id)
            ->with('comments')->first();
        $courseInfo             = new CourseTrainingResource($courseInfo);
        $courseInfo->additional = ['is_one' => true];

        return $this->success_response($courseInfo,tt('you_get_course_info'));
    }

    /**
     *  /instructors/{id?}
     * [ارجاع معلومات مدرب معين  .]
     * @bodyParam id  number    required  المدرب المراد عرض بياناته كاملة
     * @group Courses
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseInstructorInfo($id){
        $teacher_info                       = TeacherDetail::findOrFail($id);
        $teacherCourses                     = $teacher_info->courses;
        $this->base_data['instructor_info'] = $teacher_info;
        $this->base_data['teacher_courses'] = $teacherCourses;

        return $this->success_response($this->base_data,
            tt('you_get_teacher_info'));
    }


    public function listMyCourses(){
        $customerCourses = CustomerCourse::
        whereCustomerId(auth()->id())
            ->orderBy('id','asc')
            ->limit($this->limit)
            ->where('id','>',$this->last_id)->get();
        if ($customerCourses->count()) {
            return $this->success_response($customerCourses,
                tt('you_get_courses').'from:'.$this->last_id.' to:'.intval($this->last_id + $this->limit));
        }
    }

    public function playCourseSubject($course_id,$subject_id){
        $courseRead = $this->makeCourseAsRead(auth()->id(),$course_id,$subject_id);
        if ($courseRead) {
            return $this->success_response($courseRead,'you success');
        }
        $this->base_data['ss'] = 'ss';

        return $this->fail_response(config('err_codes.data_not_update'),tt('you play course but not updated'));
    }

}
