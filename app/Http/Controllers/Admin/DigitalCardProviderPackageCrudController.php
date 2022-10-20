<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CrudTraits\DigitalCardTrait;
use App\Http\Requests\DigitalCardProviderPackageRequest;
use App\Models\DigitalCardsProvider;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class DigitalCardProviderPackageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DigitalCardProviderPackageCrudController extends CrudController
{
    protected $parentEntity;
    protected $provider_id;
    use DigitalCardTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup(){
        CRUD::setModel(\App\Models\DigitalCardProviderPackage::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/digitalcardproviderpackage');

        CRUD::setEntityNameStrings(trans('lang.digitalcardproviderpackage'),
            trans('lang.digital_card_provider_packages'));
        CRUD::orderBy('updated_at','desc');
        $this->parentEntity = request()->segment(2);
        if ($this->parentEntity == 'digitalcardsprovider') {
            // Get the parent service
            $this->provider_id = request()->segment(3);
            // Get the Parent name
            $provider = DigitalCardsProvider::findOrFail($this->provider_id);
            $this->crud->with(['provider']);
            $this->crud->allowAccess(['parent']);

            $this->crud->setRoute(admin_uri('digitalcardsprovider/'
                .$this->provider_id.'/packages'));
            $this->crud->addClause('where','d_card_provider_id','=',$this->provider_id);
            $this->data['breadcrumbs'] = [
                trans('backpack::crud.admin')     => backpack_url('dashboard'),
                trans('lang.digital_cards_providers').'('.$provider->name.')'
                => backpack_url('digitalcardsprovider/'.$this->provider_id.'/show'),
                'الفئات التابعة' => backpack_url('digitalcardsprovider/'.$this->provider_id.'/packages'),
                trans('backpack::crud.list') => false,
            ];
        }
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        CRUD::addColumns([

            [
                'name'        => 'provider',
                'type'        => 'relationship',
                'label'       => trans('lang.provider_name'),
                'attribute'   => 'name',
                'orderable'   => true,
                'searchLogic' => function ($query,$column,$searchTerm){
                    $query->orWhereHas('provider',function ($q) use ($column,$searchTerm){
                        $q->where('name','like','%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    // 'element' => 'a', // the element will default to "a" so you can skip it here
                    'href' => function ($crud,$column,$entry,$related_key){
                        return backpack_url('digitalcardsprovider/'.$related_key.'/show');
                    },
                ],

            ],
            [

                'entity'      => 'store',
                'model'       => 'App\\Models\\DigitalCardStore',
                'attribute'   => 'name',
                'orderable'   => true,
                'label'       => trans('lang.store_name'),
                'searchLogic' => function ($query,$column,$searchTerm){
                    $query->orWhereHas('store',function ($q) use ($column,$searchTerm){
                        $q->where('name','like','%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    // 'element' => 'a', // the element will default to "a" so you can skip it here
                    'href' => function ($crud,$column,$entry,$related_key){
                        return backpack_url('digitalcardstore/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.package_name'),
            ],
            [
                'name'       => 'price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.price_dollar'),

            ],
            [
                'name'          => 'expire_days',
                'type'          => 'model_function',
                'function_name' => 'getExpireDaysHtml',
                'label'         => trans('lang.expire_days'),
            ],
            [
                'name'          => 'updated_at',
                'type'          => 'model_function',
                'function_name' => 'getUpdatedAtHtml',
                'label'         => trans('lang.updated_at'),
            ],
            /*[
                'name'  => 'image',
                'type'  => 'image',
                'label' => trans('lang.package_image'),

            ],*/

        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(){
        if (!empty($this->provider_id)) {
            $this->crud->addField([
                'name'  => 'd_card_provider_id',
                'type'  => 'hidden',
                'value' => $this->provider_id,
            ],'create');
        } else {
            $this->crud->addField(

                [
                    'type'       => 'select2',
                    'name'       => 'd_card_provider_id',
                    'entity'     => 'provider',
                    'model'      => 'App\\Models\\DigitalCardsProvider',
                    'attribute'  => 'name',
                    'label'      => trans('lang.provider_name'),
                    'attributes' => [
                        'placeholder' => trans('lang.provider_name'),
                    ],
                ]);
        }
        $this->crud->addFields([

            [
                'type'       => 'select2',
                'name'       => 'store_id',
                'entity'     => 'store',
                'model'      => 'App\\Models\\DigitalCardStore',
                'attribute'  => 'name',
                'label'      => trans('lang.store_name'),
                'attributes' => [
                    'placeholder' => trans('lang.store_name'),
                ],
            ],
            [
                'name'       => 'name',
                'type'       => 'text',
                'attributes' => ["required" => "required"],
                'label'      => trans('lang.package_name'),

            ],[
                'name'       => 'price',
                'type'       => 'number',
                'attributes' => ["step" => "any",'min' => 0.001,"required" => "required"],
                'label'      => trans('lang.price_dollar'),

            ],
            [
                'name'  => 'expire_days',
                'type'  => 'number',
                'label' => trans('lang.expire_days'),

            ],/*[
                'type'      => 'select2',
                'name'      => 'currency_id',
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
            ],*//*[
                'name'  => 'image',
                'type'  => 'image',
                'label' => trans('lang.package_image'),

            ],*/

        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation(){
        $this->setupCreateOperation();
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(){
        $posted      = $this->crud->getStrippedSaveRequest();
        $provider_id = $posted['d_card_provider_id'];
        $store_id    = $posted['store_id'];
        $price       = $posted['price'];
        if ($this->checkIsFoundProviderPackagePrice($provider_id,$store_id,$price)) {
            Alert::error('هذة الفئة لهذا المتجر وبهذا السعر قد أضيفت من قبل')->flash();

            return redirect()->back()->withInput();
        }
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitStore();
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update(){
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitUpdate();
    }
    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }
}
