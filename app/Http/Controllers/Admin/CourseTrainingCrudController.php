<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseTrainingRequest;
use App\Models\TeacherDetail;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseTrainingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseTrainingCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CourseTraining::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/coursetraining');
        CRUD::setEntityNameStrings(trans('lang.coursetraining'),trans('lang.course_trainings'));


        //CRUD::addButtonFromModelFunction()
        $this->crud->enableDetailsRow();

        if ($this->crud->getCurrentOperation() == 'list') {
            $this->crud->addButtonFromModelFunction('line','courseExercises','exercisesBtn','beginning');
            $this->crud->addButtonFromModelFunction('line','subjects','subjectsBtn','beginning');
            $this->crud->addButtonFromModelFunction('line','parts','partsBtn','beginning');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    protected function setupListOperation(){
        $this->crud->enableDetailsRow();

        $this->crud->addColumns([
            [
                'name'      => 'teacher',
                'type'      => 'relationship',
                'label'     => trans('lang.teacher'),
                'attribute' => 'TeacherName',

            ],
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'category',
                'type'  => 'relationship',
                'label' => trans('lang.coursecategory'),
            ],
            [
                'name'  => 'language',
                'type'  => 'enum',
                'label' => trans('lang.language'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'requirements',
                'type'  => 'textarea',
                'label' => trans('lang.requirements'),
            ],
            [
                'name'  => 'what_learn',
                'type'  => 'textarea',
                'label' => trans('lang.what_learn'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],
            /* [
                'name'  => 'price',
                'type'  => 'text',
                'label' => trans('lang.price'),
            ],
            [
                'name'  => 'currency',
                'type'  => 'relationship',
                'label' => trans('lang.currency'),
            ],
            [
                'name'  => 'currency',
                'type'  => 'relationship',
                'label' => trans('lang.currency'),
            ],
           [
                'name'  => 'discount',
                'type'  => 'text',
                'label' => trans('lang.discount'),
            ],
            [
                'name'  => 'discount_type',
                'type'  => 'enum',
                'label' => trans('lang.discount_type'),
            ],
            [
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
            ],*/
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],
            /*   [
                   'name'  => 'level',
                   'type'  => 'enum',
                   'label' => trans('lang.level'),
               ],
               [
                   'name'  => 'subjects_count',
                   'type'  => 'number',
                   'label' => trans('lang.subjects_count'),
               ],
               [
                   'name'  => 'duration',
                   'type'  => 'text',
                   'label' => trans('lang.duration'),
               ],
               [
                   'name'  => 'total_students',
                   'type'  => 'number',
                   'label' => trans('lang.total_students'),
               ],
               [
                   'name'  => 'rating',
                   'type'  => 'text',
                   'label' => trans('lang.rating'),
               ],*/
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
        CRUD::setValidation(CourseTrainingRequest::class);

        CRUD::addFields([

            [
                'type'       => 'select2',
                'name'       => 'teacher_id',
                'entity'     => 'teacher',
                'model'      => 'App\\Models\\TeacherDetail',
                'attribute'  => 'TeacherName',
                'label'      => trans('lang.teacher'),
                'attributes' => [
                    'placeholder' => trans('lang.Choose_services'),
                ],
            ],
            [
                'type'      => 'select2',
                'name'      => 'course_category_id',
                'entity'    => 'category',
                'model'     => 'App\\Models\\CourseCategory',
                'attribute' => 'name',
                'label'     => trans('lang.coursecategory'),

            ],


            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name_course'),
            ],
            [
                'name'  => 'language',
                'type'  => 'enum',
                'label' => trans('lang.language'),
            ],
            [
                'name'  => 'description',
                'type'  => 'ckeditor',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'requirements',
                'type'  => 'ckeditor',
                'label' => trans('lang.requirements'),
            ],
            [
                'name'  => 'what_learn',
                'type'  => 'ckeditor',
                'label' => trans('lang.what_learn'),
            ],
            [

                'name' => "img_path",
                'type' => 'image',
                'crop' => true, // set to true to allow cropping, false to disable
            ],
            [
                'name'       => 'price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.price'),
            ],
            [
                'name'  => 'currency',
                'type'  => 'relationship',
                'label' => trans('lang.currency'),
            ],
            [
                'name'  => 'currency',
                'type'  => 'relationship',
                'label' => trans('lang.currency'),
            ],
            [
                'name'       => 'discount',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.discount'),
            ],
            [
                'name'  => 'discount_type',
                'type'  => 'enum',
                'label' => trans('lang.discount_type'),
            ],
            [
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],
            [
                'name'  => 'level',
                'type'  => 'enum',
                'label' => trans('lang.level'),
            ],
            [
                'name'  => 'subjects_count',
                'type'  => 'number',
                'label' => trans('lang.subjects_count'),
            ],
            [
                'name'       => 'duration',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.duration'),
            ],
            [
                'name'  => 'total_students',
                'type'  => 'number',
                'label' => trans('lang.total_students'),
            ],/*  [
                'name'  => 'subjects_count',
                'type'  => 'number',
                'label' => trans('lang.subjects_count'),
            ],
            [
                'name'       => 'duration',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.duration'),
            ],
            [
                'name'  => 'total_students',
                'type'  => 'number',
                'label' => trans('lang.total_students'),
            ],*/
            [
                'name'       => 'rating',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.rating'),
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
        $this->setupShowOneOperation();
    }

    protected function setupShowOneOperation(){
        $this->crud->addColumns([
            [
                'name'      => 'teacher',
                'type'      => 'relationship',
                'label'     => trans('lang.teacher'),
                'attribute' => 'TeacherName',

            ],
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'category',
                'type'  => 'relationship',
                'label' => trans('lang.coursecategory'),
            ],
            [
                'name'  => 'language',
                'type'  => 'enum',
                'label' => trans('lang.language'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'requirements',
                'type'  => 'textarea',
                'label' => trans('lang.requirements'),
            ],
            [
                'name'  => 'what_learn',
                'type'  => 'textarea',
                'label' => trans('lang.what_learn'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],
            [
                'name'  => 'price',
                'type'  => 'text',
                'label' => trans('lang.price'),
            ],
            [
                'name'  => 'currency',
                'type'  => 'relationship',
                'label' => trans('lang.currency'),
            ],
            [
                'name'  => 'currency',
                'type'  => 'relationship',
                'label' => trans('lang.currency'),
            ],
            [
                'name'  => 'discount',
                'type'  => 'text',
                'label' => trans('lang.discount'),
            ],
            [
                'name'  => 'discount_type',
                'type'  => 'enum',
                'label' => trans('lang.discount_type'),
            ],
            [
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],
            [
                'name'  => 'level',
                'type'  => 'enum',
                'label' => trans('lang.level'),
            ],
            [
                'name'  => 'subjects_count',
                'type'  => 'number',
                'label' => trans('lang.subjects_count'),
            ],
            [
                'name'  => 'duration',
                'type'  => 'text',
                'label' => trans('lang.duration'),
            ],
            [
                'name'  => 'total_students',
                'type'  => 'number',
                'label' => trans('lang.total_students'),
            ],
            [
                'name'  => 'rating',
                'type'  => 'text',
                'label' => trans('lang.rating'),
            ],
        ]);
    }
}
