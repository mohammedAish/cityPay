<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomersLoyaltyPointsPriceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomersLoyaltyPointsPriceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomersLoyaltyPointsPriceCrudController extends CrudController
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
    public function setup()
    {
        CRUD::setModel(\App\Models\CustomersLoyaltyPointsPrice::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customersloyaltypointsprice');
        CRUD::setEntityNameStrings('customersloyaltypointsprice', 'customers_loyalty_points_prices');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    /**
     * `customer_id`, `customers_service_package_id`,
     * `count_scores`, `score_type`, `transferred`,
     * `transferred_date`, `transferred_by
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([

//           [
//            'name'=>'customer',
//            'type'=>'relationship',
//            'label'=>trans('lang.customer'),
//            ],

//            [
//             'name'=>'customers_service_package',
//             'type'=>'relationship',
//             'label'=>trans('lang.customers_service_package'),
//            ],
            [
                'name'=>'count_scores',
                'type'=>'number',
                'label'=>trans('lang.count_scores'),
            ],
            [
                'name'=>'transferred',
                'type'=>'number',
                'label'=>trans('lang.transferred'),
            ],
            [
                'name'=>'score_type',
                'type'=>'enum',
                'label'=>trans('lang.score_type'),
            ],
            [
                'name'=>'transferred_date',
                'type'=>'date',
                'label'=>trans('lang.transferred_date'),
            ],
            [
                'name'=>'transferred_by',
                'type'=>'enum',
                'label'=>trans('lang.transferred_by'),
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomersLoyaltyPointsPriceRequest::class);

        CRUD::addFields([

//            [
//                'name'=>'customer',
//                'type'=>'relationship',
//                'label'=>trans('lang.customer'),
//            ],

//            [
//                'name'=>'customers_service_package',
//                'type'=>'relationship',
//                'label'=>trans('lang.customers_service_package'),
//            ],
            [
                'name'=>'count_scores',
                'type'=>'number',
                'label'=>trans('lang.count_scores'),
            ],
            [
                'name'=>'transferred',
                'type'=>'number',
                'label'=>trans('lang.transferred'),
            ],
            [
                'name'=>'score_type',
                'type'=>'enum',
                'label'=>trans('lang.score_type'),
            ],
            [
                'name'=>'transferred_date',
                'type'=>'date',
                'label'=>trans('lang.transferred_date'),
            ],
            [
                'name'=>'transferred_by',
                'type'=>'enum',
                'label'=>trans('lang.transferred_by'),
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
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
