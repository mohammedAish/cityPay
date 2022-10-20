<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositAgencyCountryRequest;
use App\Models\DepositAgency;
use App\Models\DepositAgencyCountry;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DepositAgencyCountryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositAgencyCountryCrudController extends CrudController
{
    protected $parentEntity;
    protected $agency_id;
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
    public function setup(){
        CRUD::setModel(\App\Models\DepositAgencyCountry::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/depositagencycountry');
        CRUD::setEntityNameStrings(trans('lang.depositagencycountry'),trans('lang.deposit_agency_countries'));
        $this->crud->denyAccess(['create']);

        $this->parentEntity = request()->segment(2);

        if ($this->parentEntity == 'depositagency') {
            // Get the parent service
            $this->agency_id = request()->segment(3);
            $curr            = $this->crud->getCurrentOperation();
            $country_name    = '';
            if ($this->crud->getCurrentOperation() != 'list') {
                $country_name = '-(';
                $country_name .= DepositAgencyCountry::findOrFail(request()->segment(5))->country->name;
                $country_name .= ')';
            }
            // Get the Parent name
            $agency_ifo = DepositAgency::findOrFail($this->agency_id);
            $this->crud->with(['depositAgency']);
            $this->crud->allowAccess(['parent']);
            $this->crud->setRoute(admin_uri('depositagency/'
                .$this->agency_id.'/fee_countries'));
            $this->crud->addClause('where','deposit_agency_id','=',$this->agency_id);
            $this->data['breadcrumbs'] = [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                trans('lang.agency_name').'('.$agency_ifo->name.')'
                                              => backpack_url('depositagency/'.$this->agency_id.'/show'),
                'رسوم العمليات'.$country_name => backpack_url('depositagency/'.$this->agency_id.'/fee_countries'),
                trans('backpack::crud.list')  => false,
            ];
        }
    }


    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        $this->crud->addColumns([
            [
                'name'          => 'country_id',
                'type'          => 'model_function',
                'function_name' => 'getCountryHtml',
                'label'         => trans('lang.country'),
            ],
            [
                'type'          => 'model_function',
                'name'          => 'deposit_agency_id',
                'function_name' => 'getDepositAgencyHtml',
                'label'         => trans('lang.agency_name'),
            ],
            [
                'name'       => 'fee_percent',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.deposit_fee'),
            ],[
                'name'       => 'withdraw_fee_percent',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.withdraw_fee_percent'),
            ],
            [
                'name'  => 'ytadawul_account_number',
                'type'  => 'text',
                'label' => trans('lang.ytadawul_account_number'),
            ],[
                'name'  => 'ytadawul_account_name',
                'type'  => 'text',
                'label' => trans('lang.ytadawul_account_name'),
            ],

            [
                'name'  => 'description',
                'type'  => 'markdown',
                'label' => trans('lang.description_transfer'),
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(){
        /* $this->crud->addFields([
             [
                 'name'  => 'country_id',
                 'type'  => 'hidden',
                 'value' => $this->country_id,
             ],
         ]);*/
        $this->crud->addFields([
            [
                'name'  => 'deposit_agency_id',
                'type'  => 'hidden',
                'value' => $this->agency_id,
            ],
        ]);


        $this->crud->addFields([
            [
                'type'       => 'select2',
                'name'       => 'country_id',
                'entity'     => 'country',
                'model'      => 'App\\Models\\Country',
                'attribute'  => 'name',
                'label'      => trans('lang.country'),
                'attributes' => ['disabled' => 'disabled'],
            ],/*
            [
                'type'       => 'select2',
                'name'       => 'deposit_agency_id',
                'entity'     => 'depositAgency',
                'model'      => 'App\\Models\\DepositAgency',
                'attribute'  => 'name',
                'label'      => trans('lang.deposit_agencies'),
                'attributes' => ['disabled' => 'disabled'],
            ],*/
            [
                'name'       => 'fee_percent',
                'type'       => 'number',
                'attributes' => ["step" => "any","max" => 100],
                'label'      => trans('lang.deposit_fee'),
            ],
            [
                'name'       => 'withdraw_fee_percent',
                'type'       => 'number',
                'attributes' => ["step" => "any","max" => 100],
                'label'      => trans('lang.withdraw_fee_percent'),
            ],
            [
                'name'  => 'ytadawul_account_number',
                'type'  => 'text',
                'label' => trans('lang.ytadawul_account_number'),
            ],[
                'name'  => 'ytadawul_account_name',
                'type'  => 'text',
                'label' => trans('lang.ytadawul_account_name'),
            ],

            [
                'name'  => 'description',
                'type'  => 'ckeditor',
                'label' => trans('lang.description_transfer'),
            ],
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
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }
}
