<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReceivingAgenciesCountryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ReceivingAgenciesCountryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReceivingAgenciesCountryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ReceivingAgenciesCountry::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/receivingagenciescountry');
        CRUD::setEntityNameStrings(trans('lang.receivingagenciescountry'),trans('lang.receiving_agencies_countries'));

        $this->parentEntity = request()->segment(2);

        if ($this->parentEntity == 'transferagency') {
            // Get the parent service
            $this->agency_id = request()->segment(3);
            $curr            = $this->crud->getCurrentOperation();
            $country_name    = '';
            if ($this->crud->getCurrentOperation() != 'list') {
                $country_name = '-(';
                $country_name .= \App\Models\ReceivingAgenciesCountry::findOrFail(request()->segment(5))->country->name;
                $country_name .= ')';
            }
            // Get the Parent name
            $agency_ifo = \App\Models\TransferAgency::findOrFail($this->agency_id);
            $this->crud->with(['transferAgency']);
            $this->crud->allowAccess(['parent']);
            $this->crud->setRoute(admin_uri('transferagency/'
                .$this->agency_id.'/fee_countries'));
            $this->crud->addClause('where','transfer_agency_id','=',$this->agency_id);
            $this->data['breadcrumbs'] = [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                trans('lang.deposit_agency').'('.$agency_ifo->agency_name.')'
                                              => backpack_url('transferagency/'.$this->agency_id.'/show'),
                'رسوم التحويل'.$country_name => backpack_url('transferagency/'.$this->agency_id.'/fee_countries'),
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
                'name'          => 'transfer_agency_id',
                'function_name' => 'getTransferAgencyHtml',
                'label'         => trans('lang.transfer_agency'),
            ],


            [
                'name'  => 'transfer_fee',
                'type'  => 'text',
                'label' => trans('lang.transfer_fee'),
            ],
            [
                'name'  => 'description',
                'type'  => 'markdown',
                'label' => trans('lang.description'),
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(){
        CRUD::setValidation(ReceivingAgenciesCountryRequest::class);
        $this->crud->addFields([
            [
                'name'  => 'transfer_agency_id',
                'type'  => 'hidden',
                'value' => $this->agency_id,
            ],
        ]);
        CRUD::addFields([
            [
                'type'       => 'select2',
                'name'       => 'country_id',
                'entity'     => 'country',
                'model'      => 'App\\Models\\Country',
                'attribute'  => 'name',
                'label'      => trans('lang.country'),
                'attributes' => ['disabled' => 'disabled'],
            ],
           /* [
                'type'       => 'select2',
                'name'       => 'transfer_agency_id',
                'entity'     => 'transferAgency',
                'model'      => 'App\\Models\\TransferAgency',
                'attribute'  => 'agency_name',
                'label'      => trans('lang.transfer_agencies'),
                'attributes' => ['disabled' => 'disabled'],
            ],*/


            [
                'name'       => 'transfer_fee',
                'type'       => 'number',
                'attributes' => ["step" => "any",'max'=>100],
                'label'      => trans('lang.transfer_fee'),
            ],
            [
                'name'  => 'description',
                'type'  => 'ckeditor',
                'label' => trans('lang.description_transfer'),
            ],
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
