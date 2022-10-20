<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FrontEndRequest;
use App\Models\FrontEnd;
use App\Rules\FileTypeValidate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Image;


/**
 * Class FrontEndCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FrontEndCrudController extends CrudController
{
    protected $homePart = 'homecontent';
    const HomeParts = [
        'homecontent', 'about', 'blog_announce', 'bg_image',
        'company_policy',
        'contact',
        'faq',
        'fauth',
        'flowstep',
        'flowstep.caption',
        'gauth',
        'homecontent',
        'howitwork',
        'howitwork.caption',
        'seo',
        'service.item',
        'social',
        'team',
        'team.caption',
        'testimonial',
        'testimonial.caption',
        'whychoose',
        'whychoose.caption',
    ];
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup() {
        CRUD::setModel(\App\Models\FrontEnd::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/frontend');
        CRUD::setEntityNameStrings('frontend', 'front_ends');
        $this->homePart = request()->segment(3);
        if (in_array($this->homePart, self::HomeParts)) {
            $this->data['post']          = FrontEnd::where('data_keys',
                $this->homePart)->first();
            $this->data['caption']       = Frontend::where('data_keys',
                $this->homePart.'.caption')->latest()->first();
            $this->data['page_title']    = $this->homePart;
            $this->data['empty_message'] = 'No Data Found';
            $this->data['howItWorks']    = Frontend::where('data_keys', $this->homePart)->latest()->paginate(10);
            $this->crud->setListView(backpack_view('frontend.'.$this->homePart));
        }
    }

    public function store(Request $request) {
        $validation_rule = ['key' => 'required'];
        foreach ($request->except('_token', 'linkedin', 'twitter', 'facebook') as $input_field => $val) {
            if ($input_field == 'has_image') {
                $validation_rule['image_input'] = ['required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, [], ['image_input' => 'image']);

        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($request->key, $request->image_input)]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];

                return back()->withNotify($notify)->withInput();
            }
        }
        // $request->merge(['lang_code' => app()->getLocale()]);


        $created_data = [
            'data_keys'   => $request->key,
            'data_values' => $request->except('_token', 'key', 'image_input'),
            'lang_code'   => app()->getLocale(),
        ];
        $created_data['data_values']=array_merge(['slug'=>$request->title],$request->except('_token', 'key', 'image_input'));
        $created      = Frontend::create($created_data);
        $notify[]     = ['success', 'Saved Successfully'];

        return back()->withNotify($notify);
    }

    public function update(Request $request, $id) {
        foreach ($request->except('_token', 'linkedin', 'twitter', 'facebook') as $input_field => $val) {
            if ($request->image_input) {
                $validation_rule['image_input'] = ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, [], ['image_input' => 'image']);

        $content = \App\Models\Frontend::findOrFail($request->id);
        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($content->data_keys, $request->image_input,
                    $content->data_values->image)]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];

                return back()->withNotify($notify);
            }
        } else {
            if (isset($content->data_values->image)) {
                $request->merge(['image' => $content->data_values->image]);
            }
        }
        $created_data=array_merge(['slug'=>$request->slug],$request->except('_token', 'key', 'image_input'));

        $content->update(['data_values' => $created_data,
                          'lang_code'   => app()->getLocale()]);
        $notify[] = ['success', 'Content has been updated.'];

        return back()->withNotify($notify);
    }

    public function store_image($key, $image, $old_image = null) {
        $path  = config('constants.frontend.'.$key.'.path');
        $size  = config('constants.frontend.'.$key.'.size');
        $thumb = config('constants.frontend.'.$key.'.thumb');

        return upload_image($image, $path, $size, $old_image, $thumb);
    }

    public function remove(Request $request) {
        $request->validate(['id' => 'required']);
        $frontend = Frontend::findOrFail($request->id);
        if (isset($frontend->data_values->image)) {
            remove_file(config('constants.frontend.team.path').'/'.$frontend->data_values->image);
        }
        $frontend->delete();
        $notify[] = ['success', 'Content has been removed.'];

        return back()->withNotify($notify);
    }

    public function bgImageUpdate(Request $request) {


        $request->validate([
            'payment_background_image'     => ' mimes:jpeg,jpg,png| max:2048',
            'how_it_work_background_image' => ' mimes:jpeg,jpg,png| max:2048',
        ]);

        if ($request->hasFile('payment_background_image')) {
            $image    = $request->file('payment_background_image');
            $filename = 'pm_bg_img.jpg';
            $location = 'assets/images/frontend/bgimage/'.$filename;
            Image::make($image)->resize(1920, 600)->save($location);
        }
        if ($request->hasFile('how_it_work_background_image')) {
            $image    = $request->file('how_it_work_background_image');
            $filename = 'work_bg_img.jpg';
            $location = 'assets/images/frontend/bgimage/'.$filename;
            Image::make($image)->resize(1920, 600)->save($location);

        }
        Artisan::call('optimize:clear');
        $notify[] = ['success', 'Update Successfully.'];

        return back()->withNotify($notify);
    }

    public function sectionAboutUpdate(Request $request, $id) {
        $request->validate([
            'title'     => 'required',
            'sub_title' => 'required',
            'details'   => 'required',
            'image'     => ' mimes:jpeg,jpg,png| max:2048',
        ]);
        $data = Frontend::where('id', $id)->where('data_keys', 'about')->firstOrFail();

        $in['title']     = $request->title;
        $in['sub_title'] = $request->sub_title;
        $in['details']   = $request->details;

        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = 'about.jpg';
            $location = 'assets/images/frontend/about/'.$filename;
            Image::make($image)->save($location);
            $in['image'] = $filename;
        }
        $data->data_values = $in;
        $data->save();
        $notify[] = ['success', 'Update Successfully.'];

        return back()->withNotify($notify);
    }

    public function flowstepEdit($id) {
        $page_title          = 'Edit Process';
        $testi               = Frontend::where('id', $id)->where('data_keys', 'flowstep')->firstOrFail();
        $icon                = str_replace('"></i>', "", str_replace('<i class="', "", $testi->data_values->icon));
        $this->data['icon']  = $icon;
        $this->data['testi'] = $testi;
        $this->setup();
        // $this->crud->setListView(backpack_view('frontend.'.$this->homePart.'.edit'));

        //  return view('admin.frontend.flowstep.edit', compact('page_title', 'testi','icon'));
    }


}
