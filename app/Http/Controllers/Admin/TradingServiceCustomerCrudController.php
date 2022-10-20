<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TradingServiceCustomerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TradingServiceCustomerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TradingServiceCustomerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TradingServiceCustomer::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/tradingservicecustomer');
        CRUD::setEntityNameStrings('tradingservicecustomer','trading_service_customers');
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
                'model'       => 'App\\Models\\Customer',
                'entity'      => 'customer',
                'attribute'   => 'name',
                'label'       => trans('lang.customer_name'),
                'searchLogic' => function ($query,$column,$searchTerm){
                    $query->orWhereHas('customer',function ($q) use ($column,$searchTerm){
                        $q->where('first_name','like','%'.$searchTerm.'%')
                            ->orWhereDate('last_name','like','%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/'.$related_key.'/show');
                    },
                ],
            ],
            //dropped from db
           /* [
                'model'       => 'App\\Models\\tradingService',
                'entity'      => 'tradingService',
                'attribute'   => 'name',
                'label'       => trans('lang.trading_service_name'),
                'searchLogic' => function ($query,$column,$searchTerm){
                    $query->orWhereHas('tradingService',function ($q) use ($column,$searchTerm){
                        $q->where('name','like','%'.$searchTerm.'%');
                    });
                },
            ],*/[
                'model'       => 'App\\Models\\tradingAgency',
                'entity'      => 'tradingAgency',
                'attribute'   => 'name',
                'label'       => trans('lang.trading_agency_name'),
                'searchLogic' => function ($query,$column,$searchTerm){
                    $query->orWhereHas('tradingAgency',function ($q) use ($column,$searchTerm){
                        $q->where('name','like','%'.$searchTerm.'%');
                    });
                },
            ],
            [
                'name'  => 'customer_agency_number',
                'type'  => 'text',
                'label' => trans('lang.customer_agency_number'),
            ],[
                'name'  => 'subscription_status',
                'type'  => 'textarea',
                'label' => trans('lang.subscription_status'),
            ],/*[
                'name'  => 'status_change_reason',
                'type'  => 'textarea',
                'label' => trans('lang.status_change_reason'),
            ],
            [
                'name'  => 'status_change_date',
                'type'  => 'datetime',
                'label' => trans('lang.status_change_date'),
            ],*/[
                'name'  => 'replay_code',
                'type'  => 'text',
                'label' => trans('lang.replay_code'),
            ],
            [
                'name'  => 'agency_replay',
                'type'  => 'textarea',
                'label' => trans('lang.agency_replay'),
            ],[
                'name'  => 'admin_note',
                'type'  => 'textarea',
                'label' => trans('lang.admin_note'),
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
                'type'      => 'select2',
                'name'      => 'customer_id',
                'entity'    => 'customer',
                'model'     => 'App\\Models\\Customer',
                'attribute' => 'name',
                'label'     => trans('lang.customer_name'),

            ],
            //dropped from db
            /*[
                'type'      => 'select2',
                'model'     => 'App\\Models\\tradingService',
                'name'      => 'trading_service_id',
                'entity'    => 'tradingService',
                'attribute' => 'name',
                'label'     => trans('lang.trading_service_name'),

            ],*/[
                'type'      => 'select2',
                'model'     => 'App\\Models\\tradingAgency',
                'entity'    => 'tradingAgency',
                'name'      => 'trading_agency_id',
                'attribute' => 'name',
                'label'     => trans('lang.trading_agency_name'),
            ],
            [
                'name'  => 'customer_agency_number',
                'type'  => 'text',
                'label' => trans('lang.customer_agency_number'),
            ],[
                'name'  => 'subscription_status',
                'type'  => 'textarea',
                'label' => trans('lang.subscription_status'),
            ],/*[
                'name'  => 'status_change_reason',
                'type'  => 'textarea',
                'label' => trans('lang.status_change_reason'),
            ],
            [
                'name'  => 'status_change_date',
                'type'  => 'datetime',
                'label' => trans('lang.status_change_date'),
            ],*/[
                'name'  => 'replay_code',
                'type'  => 'text',
                'label' => trans('lang.replay_code'),
            ],
            [
                'name'  => 'agency_replay',
                'type'  => 'textarea',
                'label' => trans('lang.agency_replay'),
            ],[
                'name'  => 'admin_note',
                'type'  => 'textarea',
                'label' => trans('lang.admin_note'),
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
