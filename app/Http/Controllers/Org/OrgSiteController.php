<?php

namespace App\Http\Controllers\Org;

use App\Http\Controllers\BaseWebController;
use App\Http\Controllers\Traits\LocalTrait;
use App\Models\Country;
use App\Models\FrontEnd;
use App\Models\OrgModels\AboutCompanyPageSetting;
use App\Models\OrgModels\AccessPolicy;
use App\Models\OrgModels\BrokerageFirm;
use App\Models\OrgModels\Certificate;
use App\Models\OrgModels\Contact_us_social_link_setups;
use App\Models\OrgModels\ContactUsPageSetting;
use App\Models\OrgModels\Counter;
use App\Models\OrgModels\News;
use App\Models\OrgModels\NewsletterSubscriber;
use App\Models\OrgModels\Offer;
use App\Models\OrgModels\PageSetup;
use App\Models\OrgModels\Partner;
use App\Models\OrgModels\PaymentCompany;
use App\Models\OrgModels\Post;
use App\Models\OrgModels\PostCategory;
use App\Models\OrgModels\Privacy_policies;
use App\Models\OrgModels\Service_features;
use App\Models\OrgModels\Services;
use App\Models\OrgModels\Slider;
use App\Models\OrgModels\WhyUs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class OrgSiteController extends BaseWebController
{
    use LocalTrait;

    public function __construct() {
        parent::__construct();
    }

    public function oldIndex() {
        $current_local      = current_local();
        $direction          = current_direction();
        $SettingSite        = $header = $this->settings[0];
        $sliders            = Slider::all()->where('showSlide', true)
            ->where('language', $current_local);
        $offers             = Offer::limit(3)
            ->where('language', $current_local)->get();
        $why_us             = WhyUs::limit(4)
            ->where('language', $current_local)->get();
        $service_categories = Services::all()
            ->where('language', $current_local);
        $certificates       = Certificate::all()
            ->where('language', $current_local);
        $news               = News::limit(3)->get()
            ->where('language', $current_local);
        $partners           = Partner::all()
            ->where('language', $current_local);
        $brokerage_firms    = BrokerageFirm::all()
            ->where('language', $current_local);
        $payment_companies  = PaymentCompany::all()
            ->where('language', $current_local);

        return view('org_web.index',
            compact('sliders', 'SettingSite', 'offers', 'why_us', 'service_categories', 'certificates',
                'news', 'partners', 'brokerage_firms', 'payment_companies', 'direction', 'current_local', 'header'));
    }



    public function aboutus() {
        $aboutus     = AboutCompanyPageSetting::all()->first();
        $page_setups = PageSetup::all()->first();
        $counters    = Counter::where('language', current_local())->limit(4)->get();
        $header      = $this->settings[0];

        return view('org_web.aboutus', compact('aboutus', 'page_setups', 'counters', 'header'));
    }

    public function search(Request $request) {
        $header      = $this->settings[0];
        $aboutus     = AboutCompanyPageSetting::all()->first();
        $page_setups = PageSetup::all()->first();
        $term        = $request->word;
        if (isset($term)) {
            $news = News::where('language', current_local())->where('new_content', 'like',
                '%'.$term.'%')->paginate(8);
        } else {
            $news = News::where('language', current_local())->paginate(8);
        }

        return view('org_web.search', compact('aboutus', 'page_setups', 'news', 'header'));
    }

    public function news() {
        $page_setups = PageSetup::all()->first();
        $header      = $this->settings[0];
        $news        = News::where('language', current_local())->paginate(8);

        return view('org_web.news', compact('page_setups', 'news', 'header'));
    }

    public function shortenLink($news_post) {
        $neww = News::with('user')->where('language', current_local())
            ->where('slug', $news_post)->first();
        if (isset($neww)) {
            $neww->increment('views');
            $PageSetup        = PageSetup::all()->first();
            $service_features = Service_features::all()->first();

            $review = PostNewwReview::where('review_for', 'news')->where('neww_id', $neww->id)->groupBy('review_type')
                ->select('review_type', DB::raw('count(*) as count'))->get();


            $author_review = PostNewwUserReview::where('review_for', 'news')->where('neww_id', $neww->id)
                ->where('writer_id', $neww->user_id)
                ->select(DB::raw('max(review) as count'))->first();


            $comments = PostNewwComment::with('user')->where('neww_id', $neww->id)->where('activated', 1)
                ->orderBy('created_at', 'desc')->paginate(4);

            return view('org_web.news_post', compact('neww', 'PageSetup', 'service_features', 'comments',
                'review', 'author_review'));
        } else {
            return view('org_web.404');
        }
    }


    public function news_post($news_post) {
        $neww = News::with('user')->where('language', current_local())
            ->where('slug', $news_post)->first();
        if (isset($neww)) {
            $neww->increment('views');
            $PageSetup        = PageSetup::all()->first();
            $service_features = Service_features::all()->first();
            $header           = $this->settings[0];

            /*    $review = PostNewwReview::where('review_for','news')->where('neww_id',$neww->id)->groupBy('review_type')
                    ->select('review_type',DB::raw('count(*) as count'))->get();

                $author_review = PostNewwUserReview::where('review_for','news')->where('neww_id',$neww->id)
                    ->where('writer_id',$neww->user_id)
                    ->select(DB::raw('max(review) as count'))->first();


                $comments = PostNewwComment::with('user')->where('neww_id',$neww->id)->where('activated',1)
                    ->orderBy('created_at','desc')->paginate(4);*/

            return view('org_web.news_post', compact('neww', 'PageSetup', 'service_features', 'header'/*,'comments',
                'review','author_review'*/));
        } else {
            return view('org_web.404');
        }
    }

    public function services() {
        $page_setups = PageSetup::all()->first();
        $services    = Services::all()->where('language', current_local());
        $header      = $this->settings[0];

        return view('org_web.services', compact('page_setups', 'services', 'header'));
    }

    public function servicePage($service) {
        $serviceItem = Services::where('slug', $service)->where('language',
            current_local())->first();
        $header      = $this->settings[0];
        if (isset($serviceItem)) {
            $PageSetup        = PageSetup::all()->first();
            $service_features = Service_features::where('language',
                current_local())->where('service_id', $serviceItem->id)->get();
            $countries        = Country::all()->pluck('name', 'id');

            return view('org_web.servicePage',
                compact('serviceItem', 'PageSetup', 'header', 'service_features', 'countries'));
        } else {
            return view('org_web.404');
        }
    }

    public function offers() {
        $header    = $this->settings[0];
        $PageSetup = PageSetup::all()->first();
        $offers    = Offer::where('language', current_local())->where('activated',
            1)->whereDate('finish_date', '>=', Carbon::now())
            ->paginate(4);

        return view('org_web.offers', compact('PageSetup', 'offers', 'header'));
    }

    public function blog() {
        $header     = $this->settings[0];
        $posts      = Post::with('category', 'users')
            ->where('language', current_local())->paginate(4);
        $categories = PostCategory::where('language', current_local())->get();

        return view('org_web.blog', compact('posts', 'categories', 'header'));
    }

    public function blog_category($category) {
        $cat        = $category;
        $posts      = Post::with('category')->where('post_category_id', $category)->where('language',
            current_local())->paginate(4);
        $categories = PostCategory::where('language', current_local())->get();

        return view('org_web.blog', compact('posts', 'categories', 'cat'));
    }

    public function blog_post($post) {
        $post = Post::where('slug', $post)->where('language', current_local())->first();
        if (isset($post)) {
            $post->increment('views');
            $header = $this->settings[0];

            /*  $comments = PostNewwComment::with('user')->where('post_id',$post->id)->where('activated',1)
                  ->orderBy('created_at','desc')->paginate(4);

              $review = PostNewwReview::where('review_for','posts')->where('post_id',$post->id)->groupBy('review_type')
                  ->select('review_type',DB::raw('count(*) as count'))->get();

              $author_review = PostNewwUserReview::where('review_for','posts')->where('post_id',$post->id)
                  ->where('writer_id',$post->author_post)
                  ->select(DB::raw('max(review) as count'))->first();*/


            return view('org_web.blog_post', compact('post', 'header'/*,'comments','review','author_review'*/));
        } else {
            return view('org_web.404');
        }
    }

    public function privacyPolicy() {
        $header         = $this->settings[0];
        $privacy_policy = Privacy_policies::all()->first();

        return view('org_web.privacyPolicy', compact('privacy_policy', 'header'));
    }

    public function accessPolicy() {
        $header        = $this->settings[0];
        $access_policy = AccessPolicy::all()->first();

        return view('org_web.accessPolicy', compact('access_policy', 'header'));
    }

    public function contact() {
        $header                       = $this->settings[0];
        $cotact_us_page_settings      = ContactUsPageSetting::all()->first();
        $cotact_us_social_link_setups = Contact_us_social_link_setups::all()->first();

        return view('org_web.contact', compact(['cotact_us_page_settings', 'cotact_us_social_link_setups', 'header']));
    }

    public function userLogin() {
        if (Auth::check()) {
            return Redirect::to('dashboard');
        }

        return view('org_web.UserLogin');
    }


    public function courses() {
        return view('org_web.courses');
    }

    public function singlecourse() {
        return view('org_web.singlecourse');
    }

    public function page404() {
        return view('org_web.404');
    }


    public function Subscribe_newsletter(Newsletter_subscribersRequest $request) {
        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);


        session()->flash('success', __('site.You Subscribe In NewsLetter Successfully'));

        return Redirect::back()->withInput($request->all());
    }

    public function review_post(Request $request) {
        $rules     =
            [
                'review_type' => 'required',
                'post_id'     => ''
                , 'neww_id'   => '',
                'review_for'  => 'required',

            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('status' => 'error', 'data' => $validator->getMessageBag()->toArray()));
        } else {
            if (isset($request->post_id)) {
                $post_revieww = PostNewwReview::where('user_id', Auth::user()->id)->where('review_for',
                    $request->review_for)
                    ->where('post_id', $request->post_id)->first();
            } else {
                $post_revieww = PostNewwReview::where('user_id', Auth::user()->id)->where('review_for',
                    $request->review_for)
                    ->where('neww_id', $request->neww_id)->first();
            }
            if (isset($post_revieww)) {
                return response()->json(['status' => 'error', 'data' => __('site.You Review this post Previously')]);
            } else {
                $post_review              = new PostNewwReview();
                $post_review->review_type = $request->review_type;
                if ($request->review_for == "posts") {
                    $post_review->post_id = $request->post_id;
                } else {
                    $post_review->neww_id = $request->neww_id;
                }

                $post_review->review_for = $request->review_for;
                $post_review->user_id    = Auth::user()->id;
                $post_review->save();

                return response()->json(['status' => 'success', 'data' => __('site.Data Added Successfully')]);
            }
        }
    }


    public function review_author(Request $request) {
        $rules     =
            [
                'review_no'  => 'required',
                'post_id'    => '',
                'neww_id'    => '',
                'writer_id'  => 'required',
                'review_for' => 'required',

            ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Response::json(array('status' => 'error', 'data' => $validator->getMessageBag()->toArray()));
        } else {
            if (isset($request->post_id)) {
                $post_revieww = PostNewwUserReview::where('user_id', Auth::user()->id)->where('review_for',
                    $request->review_for)
                    ->where('writer_id', $request->writer_id)
                    ->where('post_id', $request->post_id)->first();
            } else {
                $post_revieww = PostNewwUserReview::where('user_id', Auth::user()->id)->where('review_for',
                    $request->review_for)
                    ->where('writer_id', $request->writer_id)
                    ->where('neww_id', $request->neww_id)->first();
            }

            if (isset($post_revieww)) {
                return response()->json(['status' => 'error', 'data' => __('site.You Review this post Previously')]);
            } else {
                $post_review         = new PostNewwUserReview();
                $post_review->review = $request->review_no;
                if ($request->review_for == "posts") {
                    $post_review->post_id = $request->post_id;
                } else {
                    $post_review->neww_id = $request->neww_id;
                }

                $post_review->review_for = $request->review_for;
                $post_review->user_id    = Auth::user()->id;
                $post_review->writer_id  = $request->writer_id;
                $post_review->save();

                return response()->json(['status' => 'success', 'data' => __('site.Data Added Successfully')]);
            }
        }
    }


}
