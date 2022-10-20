<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerCourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerCourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerCourseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CustomerCourse::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/customercourse');
        CRUD::setEntityNameStrings('customercourse','customer_courses');
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
                'name'  => 'course',
                'type'  => 'relationship',
                'label' => trans('lang.course'),
            ],
            [
                'name'  => 'customer',
                'type'  => 'relationship',
                'label' => trans('lang.customer'),
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name'  => 'joined_date',
                'type'  => 'date',
                'label' => trans('lang.joined_date'),
            ],

            [
                'name'  => 'final_degree',
                'type'  => 'text',
                'label' => trans('lang.final_degree'),
            ],
            [
                'name'  => 'level_result',
                'type'  => 'enum',
                'label' => trans('lang.level_result'),
            ],
            [
                'name'  => 'customer_note',
                'type'  => 'textarea',
                'label' => trans('lang.customer_note'),
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
        CRUD::setValidation(CustomerCourseRequest::class);

        CRUD::addFields([
            [
                'type'       => 'select2',
                'name'       => 'course_id',
                'entity'     => 'course',
                'model'      => 'App\\Models\\CourseTraining',
                'attribute'  => 'name',
                'label'      => trans('lang.course'),
                'attributes' => [
                    'placeholder' => trans('lang.course'),
                ],
            ],
            [
                //   'type'      => 'select2',
                'name'      => 'customer_id',
                'entity'    => 'customer',
                'model'     => 'App\\Models\\Customer',
                'attribute' => 'name',
                'label'     => trans('lang.customer_name'),

            ],
            [
                'name'       => 'final_degree',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.final_degree'),
            ],
            [
                'name'  => 'level_result',
                'type'  => 'enum',
                'label' => trans('lang.level_result'),
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
