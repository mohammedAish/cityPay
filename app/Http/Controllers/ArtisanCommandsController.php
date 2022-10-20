<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Comment;
use App\Models\Consultant;
use App\Models\ConsultantOrderProcedure;
use App\Models\ConsultantsCategory;
use App\Models\CourseCategory;
use App\Models\CourseExercise;
use App\Models\CoursePart;
use App\Models\CourseSubject;
use App\Models\CourseSubjectAttachment;
use App\Models\CourseTraining;
use App\Models\Customer;
use App\Models\CustomerConsultantOrder;
use App\Models\CustomerCourse;
use App\Models\OrgModels\AboutCompanyPageSetting;
use App\Models\OrgModels\Counter;
use App\Models\OrgModels\PageSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanCommandsController extends BaseWebController
{
    function clearCache(){
       // whatThis();
        $status = Artisan::call('config:cache');

        return '<h1>Cache cleared</h1>';
    }
    public function about_us(){
        $aboutus     = AboutCompanyPageSetting::all()->first();
        $page_setups = PageSetup::all()->first();
        $counters    = Counter::where('language', current_local())->limit(4)->get();
        $header      = $this->settings[0];

        return view('org_web.aboutus',compact('aboutus','page_setups','counters','header'));
    }
    function copy(){
        try{
           // $copy = copy( 'http://demo.ytadawul.com/storage/AgenciesPicts.zip', 'picts.zip' );
        }catch (\Exception $ex){

        }
    }
    function migrateDB(){
        try {
            $status=Artisan::call('migrate');

            return '<h1>migrated'. $status.'</h1>';

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }function truncateGB(){
        try {
            Badge::truncate();
            Comment::truncate();
            \Laravelista\Comments\Comment::truncate();
            Consultant::truncate();
            ConsultantsCategory::truncate();
            ConsultantOrderProcedure::truncate();
            CourseCategory::truncate();
            CoursePart::truncate();
            CourseTraining::truncate();
            CourseSubject::truncate();
            CourseExercise::truncate();
            CourseSubjectAttachment::truncate();
            Customer::truncate();
            CustomerCourse::truncate();
            CustomerConsultantOrder::truncate();

            return '<h1>done</h1>';

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }



    function routeCache(){
        $status = Artisan::call(' route:cache');

        return '<h1>Route  cleared,cached</h1>';
    }
    function routeClear(){
        $status = Artisan::call(' route:clear');

        return '<h1>Route  cleared,cached</h1>';
    }

    function optimizeCache(){
        try {
            $status = Artisan::call('optimize');

            return '<h1>optimize execute</h1>';
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    function optimizeClear(){
        try {
            $status = Artisan::call('optimize:clear');

            return '<h1>optimize execute</h1>';
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    function clearCompiled(){
        try {
            $status = Artisan::call('clear-compiled');

            return '<h1>clear-compiled execute</h1>';
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    function storageLnk(){
        try {
            $status = Artisan::call('storage:link');

            return '<h1>storage linked</h1>';
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    function telspub(){
        try {
            $status=Artisan::call('telescope:publish');

            return '<h1>tels pub</h1>';
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }  function telsclear(){
        try {
            $status=Artisan::call('telescope:clear');

            return '<h1>tels cleared</h1>';
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    function keyGenerate(){
        try {
            $status=Artisan::call('key:generate');

            return '<h1>generated  </h1>'.$status;
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }function envIs(){
        try {
            $status=Artisan::call('env');

            return '<h1>env is  </h1>'.$status;
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
