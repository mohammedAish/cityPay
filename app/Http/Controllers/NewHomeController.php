<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\LocalTrait;
use App\Models\DepositAgency;
use App\Models\FrontEnd;
use Illuminate\Http\Request;

class NewHomeController extends BaseWebController
{
    use LocalTrait;

    public function index() {

        $frontEnd                  = FrontEnd::where('lang_code', app()->getLocale())->get();
        $data['homeContent']       = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'homecontent';
        })->sortByDesc('created_at')->first();
        $data['hometitle']         = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'homecontent';
        })->first();
        $data['about']             = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'about';
        })->first();
        $data['flowstep_caption']  = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'flowstep.caption';
        })->first();
        $data['flowsteps']         = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'flowstep';
        })->all());
        $data['whychoose_caption'] = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'whychoose.caption';
        })->first();
        $data['whychooses']        = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'whychoose';
        })->all());

        $data['team_caption']        = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'team.caption';
        })->first();
        $data['teams']               = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'team';
        })->all());
        $data['howitwork_caption']   = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'howitwork.caption';
        })->first();
        $data['howitworks']          = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'howitwork';
        })->all());
        $data['testimonial_caption'] = $frontEnd->filter(function ($item) {
            return $item->data_keys == 'testimonial.caption';
        })->first();
        $data['testimonials']        = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'testimonial';
        })->all());
        $data['faqs']                = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'faq';
        })->all());
        $data['blogs']               = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'blog_announce';
        }))->sortByDesc('created_at')->take(3)->all();
        $data['company_policy']      = collect($frontEnd->filter(function ($item) {
            return $item->data_keys == 'company_policy';
        }))->all();


        $data['weAccept'] = DepositAgency::where('active', 1)->get();

        return view('home.home', $data);
    }
    public function privacy() {
        return view('home.privacyy');
    }
    public function agreement() {
        return view('home.agreement');
    }
    public function licenses() {
        return view('home.licenses');
    }

    public function policyInfo($id, $slug = null) {
        $frontEnd = FrontEnd::where('lang_code', app()->getLocale())->get();
        $menu     = $frontEnd->filter(function ($item) use ($id) {

            return isset($item->data_values->slug) && $item->data_values->slug == $id;


        })->first();
        /*       $menu = FrontEnd::where('data_keys','company_policy')
                   ->whereJsonContains('data_keys->slug',$id)->first();*/

         $page_title = $menu->data_values->title;
        return view('home.policy', compact('menu','page_title'));
    }
}
