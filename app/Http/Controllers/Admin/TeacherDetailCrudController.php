<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeacherDetailRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TeacherDetailCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TeacherDetailCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TeacherDetail::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/teacherdetail');
        CRUD::setEntityNameStrings(trans('lang.teacherdetail'), trans('lang.teacher_details'));
        $this->crud->enableDetailsRow();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    /**
    `customer_id`, `last_certificate`, `classification`,
     * `scores`, `skills`, `rating`, `join_date`, `active`,
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name'  => 'customer',
                'type'  => 'relationship',
                'label' => trans('lang.customer'),

            ],
            [
                'name'  => 'last_certificate',
                'type'  => 'date',
                'label' => trans('lang.last_certificate'),

            ],
            [
                'name'  => 'classification',
                'type'  => 'text',
                'label' => trans('lang.classification'),
            ],
            [
                'name'  => 'scores',
                'type'  => 'text',
                'label' => trans('lang.scores'),
            ],
            [
                'name'  => 'skills',
                'type'  => 'textarea',
                'label' => trans('lang.skills'),
            ],
            [
                'name'  => 'rating',
                'type'  => 'text',
                'label' => trans('lang.rating'),
            ],
            [
                'name'  => 'join_date',
                'type'  => 'date',
                'label' => trans('lang.join_date'),
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
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
        CRUD::setValidation(TeacherDetailRequest::class);

        CRUD::addFields([
            [
                'type'       => 'select2',
                'name'       => 'customer_id',
                'entity'     => 'customer',
                'model'      => 'App\\Models\\Customer',
                'attribute'  => 'first_name',
                'label'      => trans('lang.customer'),
                'attributes' => [
                    'placeholder' => trans('lang.Choose_services'),
                ],
            ],
            [
                'name'  => 'last_certificate',
                'type'  => 'date',
                'label' => trans('lang.last_certificate'),
            ],
            [
                'name'  => 'classification',
                'type'  => 'text',
                'label' => trans('lang.classification'),
            ],
            [
                'name'  => 'scores',
                'type'  => 'number',
                'attributes' => ["step" => "any"],
                'label' => trans('lang.scores'),
            ],
            [
                'name'  => 'skills',
                'type'          => 'ckeditor',
                'label' => trans('lang.skills'),
            ],
            [
                'name'  => 'rating',
                'type'  => 'number',
                'attributes' => ["step" => "any"],
                'label' => trans('lang.rating'),
            ],
            [
                'name'  => 'join_date',
                'type'  => 'date',
                'label' => trans('lang.join_date'),
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],

        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
