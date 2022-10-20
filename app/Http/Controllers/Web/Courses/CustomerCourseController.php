<?php

namespace App\Http\Controllers\Web\Courses;

use App\Events\WalletTransactionEvent;
use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\CourseTrait;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CustomerOrderRequest;
use App\Models\CourseTraining;
use App\Models\CustomerCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Prologue\Alerts\Facades\Alert;


class CustomerCourseController extends BaseWebController
{
    use CourseTrait;

    public function courseOrder(CustomerOrderRequest $request) {
        $courseId   = $request->input('course_id');
        $courseInfo = CourseTraining::findOrFail($courseId);
        if (!$courseInfo->active) {
            Alert::error(trans('lang.this_item_not_available'))->flush();

            return redirect()->back()->withInput();
        }
        //get real price
        $coursePrice = getPriceFromDiscount($courseInfo);
        //check balance
        if ($coursePrice > auth()->user()->balanceFloat) {
            Alert::error(trans('lang.no_enough_balance'))->flush();

            return redirect()->back()->withInput();
        }
        try {
            \DB::beginTransaction();
            $dataInsert     = [
                'course_id'   => $courseInfo->id, 'customer_id' => auth()->id(),
                'joined_date' => now()->toDateTimeString(),
                /* 'customer_note' => isset($request->input('note'))?:'',*/
            ];
            $courseInserted = CustomerCourse::create([$dataInsert]);

            //create LoyaltyPoints
            $loyaltyPoints = $this->createLoyaltyPointsForService(
                config('ytadawul.all_services.training'),
                'CourseTraining', $courseInserted->id, auth()->id());
            view()->share('loyaltyPoints', $loyaltyPoints);


            // make the withdraw
            $withdraw_result = auth()->user()->withdrawFloat($coursePrice);

            Event::dispatch(new WalletTransactionEvent($withdraw_result, 'CourseTraining', $courseInserted->id));

            view()->share('withdraw_result', $withdraw_result);
            view()->share('current_balance', auth()->user()->balanceFloat);
            \DB::commit();
            $courseInserted->load('course');
            view()->share('courseInfo', $courseInserted);

            return response()->json($courseInserted);
        } catch (\Exception $ex) {
            Alert::error(trans('lang.we_cant_offer_your_order').' reason is'.$ex->getMessage())->flush();

            return redirect()->back()->withInput();
        }
    }

    public function listMyCourses() {
        $customerCourses = CustomerCourse::
        whereCustomerId(auth()->id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('profile.my-courses')
            ->with('courses', $customerCourses);
    }

    /**
     * @param  Request  $request
     *when play a video from course
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function playCourseSubject(Request $request) {
        $course_id  = $request->input('course_id');
        $subject_id = $request->input('subject_id');
        $courseRead = $this->makeCourseAsRead(auth()->id(), $course_id, $subject_id);
        if ($courseRead) {
            return response()->json(['status' => true, 'data' => $courseRead]);
        }

        return response()->json(['status' => false, 'data' => []]);
    }

    public function courseWithSubjectInfo($course_id = 0) {
        $courseInfo = CourseTraining::whereId($course_id)
            ->with('courseSubjects')->with('comments')->first();

        return view('courses.course-area')
            ->with('course_info', $courseInfo);
    }

    public function addComment(CommentRequest $request) {

        return response()->json(["status" => "success", 'message' => "تم اضافة التعليق بنجاح"]);
    }

}
