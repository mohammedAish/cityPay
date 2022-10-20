<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositMethodRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DepositMethodCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositMethodCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DepositMethod::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/depositmethod');
        CRUD::setEntityNameStrings(trans('lang.depositmethod'),trans('lang.deposit_methods'));
       // CRUD::denyAccess(['create','delete']);
        $this->crud->orderBy('id','asc');
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
                'name'  => 'id',
                'type'  => 'text',
                'label' => trans('lang.id'),
            ],[
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],[
                'name'  => 'deposit_type',
                'type'  => 'enum',
                'label' => trans('lang.deposit_type'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],[
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
        CRUD::setValidation(DepositMethodRequest::class);

        $this->crud->addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],[
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

    /**
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }
}
