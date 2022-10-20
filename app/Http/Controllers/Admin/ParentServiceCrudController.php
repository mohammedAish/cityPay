<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ParentServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ParentServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ParentServiceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ParentService::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/parentservice');
        CRUD::setEntityNameStrings(trans('lang.parentservice'),trans('lang.parent_services'));
       // CRUD::denyAccess(['create','delete']);
        CRUD::orderBy('id','asc');
        if ($this->crud->getCurrentOperation() == 'list') {
            $this->crud->addButtonFromModelFunction('line','services','servicesBtn','beginning');
            $this->crud->addButtonFromModelFunction('line','servicesFeatures','featuresBtn','ending');

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
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],

            [

                'type'  => 'boolean',
                'label' => trans('lang.active'),
                'name'          => 'active',

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
        CRUD::setValidation(ParentServiceRequest::class);

        CRUD::addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],

            [
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
