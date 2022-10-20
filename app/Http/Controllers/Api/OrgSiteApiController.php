<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrgModels\AboutCompanyPageSetting;
use App\Models\OrgModels\AccessPolicy;
use App\Models\OrgModels\BrokerageFirm;
use App\Models\OrgModels\Certificate;
use App\Models\OrgModels\Contact_us_social_link_setups;
use App\Models\OrgModels\ContactUsPageSetting;
use App\Models\OrgModels\Counter;
use App\Models\OrgModels\News;
use App\Models\OrgModels\Offer;
use App\Models\OrgModels\PageSetup;
use App\Models\OrgModels\Partner;
use App\Models\OrgModels\PaymentCompany;
use App\Models\OrgModels\Post;
use App\Models\OrgModels\PostCategory;
use App\Models\OrgModels\Privacy_policies;
use App\Models\OrgModels\Service_features;
use App\Models\OrgModels\Services;
use App\Models\OrgModels\SiteSetting;
use App\Models\OrgModels\Slider;
use App\Models\OrgModels\WhyUs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrgSiteApiController extends BaseApiController
{

    /**
     *
     * get_site_setting
     *[ارجاع اعدادات وبيانات السايت الرئيسية   .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function getSiteSettings(){
        $sittings = SiteSetting::all();//->where('language',current_local());

        return $this->success_response($sittings,trans('you get all site settings'));
    }

    /**
     * get_site_slides
     * [ارجاع  بيانات السلايدز   .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function listSlides(){
        $slides = Slider::all()->where('showSlide',true)
            ->where('language',current_local());

        return $this->success_response($slides,trans('you get all slides'));
    }

    /**
     * get_site_slides
     * [ارجاع  بيانات السلايدز   .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function listOffers(){
        $offers = Offer::all()
            ->where('language',current_local());

        return $this->success_response($offers,trans('you get all slides'));
    }

    /**
     * home_site_data
     * [ارجاع  كل بيانات الصفحة الرئيسية    .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function getAllHomePageData(){
        $current_local        = current_local();
        $data['site_setting'] = SiteSetting::all();;
        $data['sliders']            = Slider::all()->where('showSlide',true)
            ->where('language',$current_local);
        $data['sliders']            = Offer::limit(10)
            ->where('language',$current_local)->get();
        $data['why_us']             = WhyUs::limit(10)
            ->where('language',$current_local)->get();
        $data['service_categories'] = Services::all()
            ->where('language',$current_local);
        $data['certificates']       = Certificate::all()
            ->where('language',$current_local);
        $data['news_list']          = News::limit(10)->get()
            ->where('language',$current_local);
        $data['partners']           = Partner::all()
            ->where('language',$current_local);
        $data['brokerage_firms']    = BrokerageFirm::all()
            ->where('language',$current_local);
        $data['payments_companies'] = PaymentCompany::all()
            ->where('language',$current_local);

        return $this->success_response($data,trans('you get all Home Data'));
    }

    /**
     * about_us
     * [ارجاع معلومات حول الشركة  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function aboutUs(){
        $data['about_us'] = AboutCompanyPageSetting::all()->first();
        //$data['page_setup'] = PageSetup::all()->first();
        $data['counters'] = Counter::where('language',current_local())->limit(4)->get();

        return $this->success_response($data,trans('you get about us Data'));
    }

    /**
     * get_all_news
     * [ارجاع قائمة الأخبار  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function listNews(){
        // $data['page_setup'] = PageSetup::all()->first();
        $data['news'] = News::where('language',current_local())->paginate(10);

        return $this->success_response($data,trans('you get News Data'));
    }

    /**
     * show_news/{id}
     *[ارجاع  خبر بعينه  .]
     * @bodyParam id integer required
     * @group HomeSite
     * @return JsonResponse
     */
    public function showNew($id = 'job'){
        $news = News::with('user')
            ->where('language',current_local())
            ->where('slug',$id)->first();
        if ($news) {
            $news->increment('views');
        }

        $data['new_data']         = $news;
      //  $data['service_features'] = Service_features::all()->first();
        return $this->success_response($data,trans('you get News Data'));
    }

    /**
     * list_blog
     * [ارجاع جميع المقالات مع فئاتها  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function listBlog(){
        $data['posts']            = Post::with('category','users')
            ->where('language',current_local())->paginate(4);
        $data['posts_categories'] = PostCategory::where('language',current_local())->get();

        return $this->success_response($data,trans('you get All Blog Data'));
    }

    /**
     * blog_category/1
     * [ارجاع مقالات مدونة لمجموعة معينة  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function blogCategory($category = 1){
        $data['posts']      = Post::with('category')->where('post_category_id',$category)
            ->where('language',
                current_local())->paginate(10);
        $data['categories'] = PostCategory::where('language',current_local())->get();

        return $this->success_response($data,trans('you get Blog for One Category'));
    }

    /**
     * privacy_policy
     * [ارجاع الخصوصية  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function privacyPolicy(){
        $privacy_policy = Privacy_policies::all()->first();

        return $this->success_response($privacy_policy,trans('you get PrivacyPolicy Data'));
    }

    /**
     * access_policy
     * [ارجاع شروط الاستخدام  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function accessPolicy(){
        $access_policy = AccessPolicy::all()->first();

        return $this->success_response($access_policy,trans('you get AccessPolicy Data'));
    }

    /**
     * contact_us
     * [ارجاع معلومات التواصل  .]
     * @group HomeSite
     * @return JsonResponse
     */
    public function contactUs(){
        $data['contact_us_']        = ContactUsPageSetting::all()->first();
        $data['contact_us_social_'] = Contact_us_social_link_setups::all()->first();

        return $this->success_response($data,trans('you get contactUs Data'));
    }

}
