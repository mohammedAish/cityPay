<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TradingCustomerPointRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TradingCustomerPointCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TradingCustomerPointCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TradingCustomerPoint::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/tradingcustomerpoint');
        CRUD::setEntityNameStrings('tradingcustomerpoint','trading_customer_points');
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

                [
                    'model'       => 'App\\Models\\tradingService',
                    'entity'      => 'tradingService',
                    'attribute'   => 'name',
                    'label'       => trans('lang.trading_service_name'),
                    'searchLogic' => function ($query,$column,$searchTerm){
                        $query->orWhereHas('tradingService',function ($q) use ($column,$searchTerm){
                            $q->where('name','like','%'.$searchTerm.'%');
                        });
                    },
                    'wrapper'     => [
                        'href' => function ($crud, $column, $entry, $related_key) {
                            return backpack_url('tradingservice/'.$related_key.'/show');
                        },
                    ],
                ],[
                    'model'       => 'App\\Models\\tradingAgency',
                    'entity'      => 'tradingAgency',
                    'attribute'   => 'name',
                    'label'       => trans('lang.trading_agency_name'),
                    'searchLogic' => function ($query,$column,$searchTerm){
                        $query->orWhereHas('tradingAgency',function ($q) use ($column,$searchTerm){
                            $q->where('name','like','%'.$searchTerm.'%');
                        });
                    },
                    'wrapper'     => [
                        'href' => function ($crud, $column, $entry, $related_key) {
                            return backpack_url('tradingagency/'.$related_key.'/show');
                        },
                    ],
                ],
                [
                    'name'  => 'operation_number',
                    'type'  => 'text',
                    'label' => trans('lang.operation_number'),
                ],[
                    'name'  => 'loyalty_points',
                    'type'  => 'text',
                    'label' => trans('lang.loyalty_points'),
                ],[
                    'name'  => 'dollar_equal',
                    'type'  => 'number',
                    'label' => trans('lang.dollar_equal'),
                ],[
                    'name'  => 'transferred',
                    'type'  => 'boolean',
                    'label' => trans('lang.transferred'),
                ],[
                    'name'  => 'win_lose',
                    'type'  => 'enum',
                    'label' => trans('lang.win_lose'),
                ],[
                    'name'  => 'transferred_date',
                    'type'  => 'datetime',
                    'label' => trans('lang.transferred_date'),
                ],
            ]

        );
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
                [
                    'type'      => 'select2',
                    'model'     => 'App\\Models\\tradingService',
                    'name'      => 'trading_service_id',
                    'entity'    => 'tradingService',
                    'attribute' => 'name',
                    'label'     => trans('lang.trading_service_name'),

                ],[
                    'type'      => 'select2',
                    'model'       => 'App\\Models\\tradingAgency',
                    'entity'      => 'tradingAgency',
                    'name'      => 'trading_agency_id',
                    'attribute'   => 'name',
                    'label'       => trans('lang.trading_agency_name'),
                ],
                [
                    'name'  => 'operation_number',
                    'attributes' => ["step" => "any"],
                    'type'  => 'number',
                    'label' => trans('lang.operation_number'),
                ],[
                    'name'  => 'loyalty_points',
                    'attributes' => ["step" => "any"],
                    'type'  => 'number',
                    'label' => trans('lang.loyalty_points'),
                ],[
                    'name'  => 'dollar_equal',
                    'type'  => 'number',
                    'attributes' => ["step" => "any"],
                    'label' => trans('lang.dollar_equal'),
                ],[
                    'name'  => 'transferred',
                    'type'  => 'boolean',
                    'label' => trans('lang.transferred'),
                ],[
                    'name'  => 'win_lose',
                    'type'  => 'enum',
                    'label' => trans('lang.win_lose'),
                ],[
                    'name'  => 'transferred_date',
                    'type'  => 'datetime',
                    'label' => trans('lang.transferred_date'),
                ],
            ]

        );
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
}
