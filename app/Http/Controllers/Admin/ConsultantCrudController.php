<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsultantRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ConsultantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ConsultantCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Consultant::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/consultant');
        CRUD::setEntityNameStrings(trans('lang.consultants'),trans('lang.consultants'));
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
                'name'  => 'category',
                'type'  => 'relationship',
                'label' => trans('lang.category'),
            ],
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.consultant_name'),
            ],
            [
                'name'  => 'consultant_type',
                'type'  => 'text',
                'label' => trans('lang.consultant_type'),
            ],[
                'name'  => 'price',
                'type'  => 'text',
                'label' => trans('lang.price'),
            ],
            [
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
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
        CRUD::setValidation(ConsultantRequest::class);
        CRUD::addFields([
            [
                'type'      => 'select2',
                'name'      => 'consultants_category_id',
                'model'     => 'App\\Models\\ConsultantsCategory',
                'entity'    => 'category',
                'attribute' => 'name',
                'label'     => trans('lang.consultantscategory'),
            ],
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.consultant_name'),
            ],

            [
                'name'  => 'consultant_type',
                'type'  => 'text',
                'label' => trans('lang.consultant_type'),
            ],
            [
                'name'  => 'price',
                'type'  => 'number',
                'attributes' => ["step" => "any"],
                'label' => trans('lang.price'),
            ],
            [
                'type'      => 'select2',
                'name'      => 'currency_id',
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ],[
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
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
