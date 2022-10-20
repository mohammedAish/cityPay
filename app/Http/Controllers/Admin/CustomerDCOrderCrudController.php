<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerDCOrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerDCOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerDCOrderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CustomerDCOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/customerdcorder');
        CRUD::setEntityNameStrings('customerdcorder','customer_d_c_orders');
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

                'entity'    => 'customer',
                'model'     => 'App\\Models\\Customer',
                'attribute' => 'name',
                'label'     => trans('lang.customer'),
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name'  => 'current_status',
                'type'  => 'enum',
                'label' => trans('lang.current_status'),
            ],
            [
                'name'  => 'total_amount',
                'type'  => 'text',
                'label' => trans('lang.total_amount'),
            ],
            [
                'name'  => 'customer_hint',
                'type'  => 'text',
                'label' => trans('lang.customer_hint'),
            ],
            [
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
        CRUD::setValidation(CustomerDCOrderRequest::class);

        CRUD::addFields([
            [
                'name'      => 'customer_id',
                'entity'    => 'customer',
                'model'     => 'App\\Models\\Customer',
                'attribute' => 'name',
                'label'     => trans('lang.customer'),
            ],

            [
                'name'  => 'current_status',
                'type'  => 'enum',
                'label' => trans('lang.current_status'),
            ],
            [
                'name'       => 'total_amount',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.total_amount'),
            ],
            [
                'name'  => 'customer_hint',
                'type'  => 'text',
                'label' => trans('lang.customer_hint'),
            ],
            [
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

    /**
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }
}
