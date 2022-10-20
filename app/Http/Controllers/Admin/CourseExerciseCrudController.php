<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseExerciseRequest;
use App\Models\CourseTraining;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseExerciseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseExerciseCrudController extends CrudController
{
    public $parentEntity = null;
    public $course_id = null;
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
        $parentEntities = ['course'];

        // Get the parent Entity slug
        $this->parentEntity = request()->segment(2);
        if (!in_array($this->parentEntity,$parentEntities)) {
            // abort(404);
        }
        CRUD::setModel(\App\Models\CourseExercise::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/courseexercise');
        CRUD::setEntityNameStrings(trans('lang.courseexercise'),trans('lang.course_exercises'));

        if ($this->parentEntity == 'coursetraining') {
            // Get the parent service
            $this->course_id = request()->segment(3);

            // Get the Parent name
            $course = CourseTraining::findOrFail($this->course_id);
            $this->crud->with(['course']);
            //  $this->crud->enable();
            $this->crud->allowAccess(['parent']);

            //set clouses
            // $this->crud->setParentKeyField('id');

            $this->crud->setRoute(admin_uri('coursetraining/'
                .$this->course_id.'/courseexercise'));
            $this->crud->addClause('where','course_id','=',$this->course_id);
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    /**
     *`course_id`, `part_id`, `sort`, `content`, `external_link`,
     * `subject_type`, `visited`, `is_helpful`, `is_not_helpful`
     */
    protected function setupListOperation(){
        $this->crud->addColumns([
            [
                'name'  => 'course',
                'type'  => 'relationship',
                'label' => trans('lang.course'),
            ],
            //deprecated
            /*[
                'name'  => 'coursePart',
                'type'  => 'relationship',
                'label' => trans('lang.coursePart'),
            ],*/
            [
                'name'  => 'sort',
                'type'  => 'number',
                'label' => trans('lang.sort'),
            ],
            [
                'name'  => 'content',
                'type'  => 'textarea',
                'label' => trans('lang.content'),
            ],
            [
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
            ],
            [
                'name'  => 'subject_type',
                'type'  => 'enum',
                'label' => trans('lang.subject_type'),
            ],
            [
                'name'  => 'visited',
                'type'  => 'number',
                'label' => trans('lang.visited'),
            ],
            [
                'name'  => 'is_helpful',
                'type'  => 'number',
                'label' => trans('lang.is_helpful'),
            ],
            [
                'name'  => 'is_not_helpful',
                'type'  => 'number',
                'label' => trans('lang.is_not_helpful'),
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
        CRUD::setValidation(CourseExerciseRequest::class);
        if (!empty($this->course_id)) {
            $this->crud->addField([
                'name'  => 'course_id',
                'type'  => 'hidden',
                'value' => $this->course_id,
            ],'create');
        } else {
            $this->crud->addField(
                [
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
                    // 'attributes' => ['disabled' => 'disabled'],
                ]);
        }
        CRUD::addFields([

            //deprecated
            /*[
                'name'  => 'coursePart',
                'type'  => 'relationship',
                'label' => trans('lang.coursePart'),
            ],*/
            [
                'name'  => 'sort',
                'type'  => 'number',
                'label' => trans('lang.sort'),
            ],
            [
                'name'  => 'content',
                'type'  => 'textarea',
                'label' => trans('lang.content'),
            ],
            [
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
            ],
            [
                'name'  => 'subject_type',
                'type'  => 'enum',
                'label' => trans('lang.subject_type'),
            ],
            [
                'name'  => 'visited',
                'type'  => 'number',
                'label' => trans('lang.visited'),
            ],
            [
                'name'  => 'is_helpful',
                'type'  => 'number',
                'label' => trans('lang.is_helpful'),
            ],
            [
                'name'  => 'is_not_helpful',
                'type'  => 'number',
                'label' => trans('lang.is_not_helpful'),
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
