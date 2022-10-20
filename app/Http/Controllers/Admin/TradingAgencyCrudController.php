<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TradingAgencyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TradingAgencyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TradingAgencyCrudController extends CrudController
{
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
        CRUD::setModel(\App\Models\TradingAgency::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/tradingagency');
        CRUD::setEntityNameStrings(trans('lang.tradingagency'),trans('lang.trading_agencies'));
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
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.agency_trading_name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'markdown',
                'label' => trans('lang.description_co_trading'),
            ],
            [
                'name' => 'services',
                'type' => 'relationship',
                'label' => trans('lang.trading_agency_services'),

            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ]/*,[
                'name'  => 'primary_email',
                'type'  => 'text',
                'label' => trans('lang.primary_email'),
            ],[
                'name'  => 'secondary_mail',
                'type'  => 'text',
                'label' => trans('lang.secondary_mail'),
            ], [
                'name'  => 'phone1',
                'type'  => 'text',
                'label' => trans('lang.phone1'),
            ],
                'name'  => 'phone2',
                'type'  => 'text',
                'label' => trans('lang.phone2'),
            ],
            [
                'name'  => 'contact_info',
                'type'  => 'text',
                'label' => trans('lang.contact_info'),
            ]*/,[
                'name'  => 'email_from_yt_to',
                'type'  => 'text',
                'label' => trans('lang.email_from_yt_to'),
            ]/*,[
                'name'  => 'email_from_cust_to',
                'type'  => 'text',
                'label' => trans('lang.email_from_cust_to'),
            ],[
                'name'  => 'agency_terms',
                'type'  => 'text',
                'label' => trans('lang.agency_terms'),
            ]*/,[
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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
        $this->crud->addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.agency_trading_name'),
            ],

            [
                'name'  => 'description',
                'type'  => 'summernote',
                'label' => trans('lang.description_co_trading'),
            ],
            [
                'name' => 'services',
                'type' => 'relationship',
                'label' => trans('lang.trading_agency_services'),

            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ],/*[
                'name'  => 'primary_email',
                'type'  => 'text',
                'label' => trans('lang.primary_email'),
            ],[
                'name'  => 'secondary_mail',
                'type'  => 'text',
                'label' => trans('lang.secondary_mail'),
            ], [
                'name'  => 'phone1',
                'type'  => 'text',
                'label' => trans('lang.phone1'),
            ],[
                'name'  => 'phone2',
                'type'  => 'text',
                'label' => trans('lang.phone2'),
            ],
            [
                'name'  => 'contact_info',
                'type'  => 'text',
                'label' => trans('lang.contact_info'),
            ],*/ [
                'name'  => 'email_from_yt_to',
                'type'  => 'text',
                'label' => trans('lang.email_from_yt_to'),
            ]/*,[
                'name'  => 'email_from_cust_to',
                'type'  => 'text',
                'label' => trans('lang.email_from_cust_to'),
            ],[
                'name'  => 'agency_terms',
                'type'  => 'text',
                'label' => trans('lang.agency_terms'),
            ]*/,[
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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

    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }

}
