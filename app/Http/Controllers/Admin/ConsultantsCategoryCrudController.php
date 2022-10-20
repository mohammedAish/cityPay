<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConsultantsCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ConsultantsCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ConsultantsCategoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ConsultantsCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/consultantscategory');
        CRUD::setEntityNameStrings(trans('lang.consultantscategory'), trans('lang.consultants_categories'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        `id`, `name`, `active`, `created_at`, `updated_at
        $this->crud->addColumns([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => trans('lang.name'),
            ], [
                'name' => 'slug',
                'type' => 'text',
                'label' => trans('lang.slug'),
            ],
            [
                'name' => 'img_path',
                'type' => 'image',
                'label' => trans('lang.image'),
            ], [
                'name' => 'short_description',
                'type' => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name' => 'active',
                'type' => 'boolean',
                'label' => trans('lang.active'),
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
        CRUD::setValidation(ConsultantsCategoryRequest::class);
        CRUD::addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => trans('lang.slug'),
                'attributes' => ['required' => 'required'],
            ],
            [
                'name' => 'img_path',
                'type' => 'image',
                'label' => trans('lang.image'),
            ], [
                'name' => 'short_description',
                'type' => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name' => 'active',
                'type' => 'boolean',
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
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
