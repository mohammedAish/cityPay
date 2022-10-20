<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CityCrudController extends CrudController
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
        CRUD::setModel(\App\Models\City::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/city');
        CRUD::setEntityNameStrings(trans('lang.city'),trans('lang.cities'));

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        CRUD::addColumn([
            'name'  => 'id',
            'type'  => 'number',
            'label' => trans("lang.id"),

        ]);
        CRUD::addColumn([
            'name'  => 'name',
            'label' => trans("lang.name"),
        ]);
        CRUD::addColumn([
            'name'  => 'name_ar',
            'label' => trans("lang.name_ar"),
        ]);
        $this->crud->addColumn([
            'label'         => trans('lang.country'),
            'name'          => 'code',       // the db column for the foreign key
            'type'          => 'model_function',
            'function_name' => 'getCityHtml',
        ]);
        CRUD::addColumn([
            'name'  => 'active',
            'type'  => 'boolean',
            'label' => trans("lang.active"),
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(){
        CRUD::setValidation(CityRequest::class);

        CRUD::addField([
            'name'  => 'name',
            'label' => trans("lang.name"),
        ]);
        CRUD::addField([
            'name'  => 'name_ar',
            'label' => trans("lang.name_ar"),
        ]);

        $this->crud->addField([
            'label'      => trans('lang.country'),
            'type'       => "relationship",
            'name'       => 'country',
            'attributes' => [
                'placeholder' => trans('lang.enter_the_country_code'),
            ],
        ]);
        $this->crud->addField([
            'name'  => 'active',
            'type'  => 'boolean',
            'label' => trans("lang.active"),
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
