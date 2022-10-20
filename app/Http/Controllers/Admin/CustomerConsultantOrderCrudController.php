<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerConsultantOrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerConsultantOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerConsultantOrderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CustomerConsultantOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/customerconsultantorder');
        CRUD::setEntityNameStrings('customerconsultantorder','customer_consultant_orders');
//
        if ($this->crud->getCurrentOperation() == 'list') {
            $this->crud->addButtonFromModelFunction('line','consultantorderprocedure','proceduresBtn','beginning');
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
                'name'  => 'customer',
                'type'  => 'relationship',
                'label' => trans('lang.customer'),
            ],
            [
                'name'  => 'consultant',
                'type'  => 'relationship',
                'label' => trans('lang.consultant_name'),
            ],
            [
                'name'  => 'joined_date',
                'type'  => 'date',
                'label' => trans('lang.joined_date'),
            ],
            [
                'name'  => 'price',
                'type'  => 'number',
                'label' => trans('lang.price'),
            ],[
                'name'  => 'is_open',
                'type'  => 'boolean',
                'label' => trans('lang.is_open'),
            ],[
                'name'  => 'current_status',
                'type'  => 'enum',
                'label' => trans('lang.current_status'),
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
                'name'  => 'customer',
                'type'  => 'relationship',
                'label' => trans('lang.customer'),
            ],
            [
                'name'  => 'consultant',
                'type'  => 'relationship',
                'label' => trans('lang.consultant_name'),
            ],
            [
                'name'  => 'joined_date',
                'type'  => 'date',
                'label' => trans('lang.joined_date'),
            ],
            [
                'name'  => 'price',
                'type'  => 'number',
                'label' => trans('lang.price'),
            ],[
                'name'  => 'is_open',
                'type'  => 'boolean',
                'label' => trans('lang.is_open'),
            ],[
                'name'  => 'current_status',
                'type'  => 'enum',
                'label' => trans('lang.current_status'),
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
