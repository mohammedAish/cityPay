<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TradingServicesOrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * هذا الكرود يعالج طلبات الاشتراك للعملاء في خدمات التداول
 * لا يمكن أن يوقم الادمن بعمل الطلب   الادمن فقط يعالج الطلب
 * Class TradingServicesOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TradingServicesOrderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TradingServicesOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/tradingservicesorder');
        CRUD::setEntityNameStrings('tradingservicesorder','trading_services_orders');
       // CRUD::denyAccess(['create']);
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

            ],
            [
                'name'  => 'order_status',
                'type'  => 'enum',
                'label' => trans('lang.order_status'),
            ],
            /*[
                'name'  => 'status_change_reason',
                'type'  => 'text',
                'label' => trans('lang.status_change_reason'),
            ],
            [
                'name'  => 'status_change_date',
                'type'  => 'datetime',
                'label' => trans('lang.status_change_date'),
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
        $this->crud->addFields([
            [
                'type'      => 'select2',
                'name'      => 'customer_id',
                'entity'    => 'customer',
                'model'     => 'App\\Models\\Customer',
                'label'     => trans('lang.customer_name'),

            ],
            [
                'type'      => 'select2',
                'model'     => 'App\\Models\\tradingService',
                'name'      => 'trading_service_id',
                'entity'    => 'tradingService',
                'label'     => trans('lang.trading_service_name'),

            ],
            [
                'name'  => 'order_status',
                'type'  => 'enum',
                'label' => trans('lang.order_status'),
            ],
           /* [
                'name'  => 'status_change_reason',
                'type'  => 'text',
                'label' => trans('lang.status_change_reason'),
            ],
            [
                'name'  => 'status_change_date',
                'type'  => 'datetime',
                'label' => trans('lang.status_change_date'),
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
}
