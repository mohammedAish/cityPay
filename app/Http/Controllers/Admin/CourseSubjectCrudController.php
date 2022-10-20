<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseSubjectRequest;
use App\Models\CoursePart;
use App\Models\CourseTraining;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseSubjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseSubjectCrudController extends CrudController
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
    public function setup() {
        $parentEntities = ['course'];
        // Get the parent Entity slug
        $this->parentEntity = request()->segment(2);
        if (!in_array($this->parentEntity, $parentEntities)) {
            // abort(404);
        }
        CRUD::setModel(\App\Models\CourseSubject::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/coursesubject');
        CRUD::setEntityNameStrings('coursesubject', 'course_subjects');

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
                .$this->course_id.'/coursesubject'));
            $this->crud->addClause('where', 'course_id', '=', $this->course_id);
            $this->data['breadcrumbs'] = [
                trans('backpack::crud.admin')  => backpack_url('dashboard'),
                trans('lang.course_trainings') => backpack_url('coursetraining'),
                $course->name                  => backpack_url('coursetraining/'.$this->course_id.'/show'),
                'الدروس'                       => backpack_url('coursetraining/'.$this->course_id.'/coursesubject'),
                trans('backpack::crud.list')   => false,
            ];
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    protected function setupListOperation() {
        $this->crud->addColumns([

            [
                'name'  => 'course',
                'type'  => 'relationship',
                'label' => trans('lang.course'),
            ],
            /* [
                 'name'  => 'coursePart',
                 'type'  => 'relationship',
                 'label' => trans('lang.course_part'),
             ],*/
            [
                'name'  => 'sort',
                'type'  => 'number',
                'label' => trans('lang.sort'),
            ],
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'subject_path',
                'type'  => 'url',
                'label' => trans('lang.subject_path'),
            ],
            [
                'name'  => 'description',
                'type'  => 'text',
                'label' => trans('lang.description'),
            ],
            [
                'name' => 'kb_volume',
                'type' => 'text',

                'label' => trans('lang.kb_volume'),
            ],
            [
                'name'  => 'duration',
                'type'  => 'text',
                'label' => trans('lang.duration'),
            ],
            [
                'name'  => 'is_free',
                'type'  => 'boolean',
                'label' => trans('lang.is_free'),
            ],
            [
                'name'  => 'visited',
                'type'  => 'number',
                'label' => trans('lang.visited'),
            ],
            [
                'name'  => 'likes',
                'type'  => 'number',
                'label' => trans('lang.likes'),
            ],
            [
                'name'  => 'dis_likes',
                'type'  => 'number',
                'label' => trans('lang.dis_likes'),
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
    protected function setupCreateOperation() {
        CRUD::setValidation(CourseSubjectRequest::class);

        if (!empty($this->course_id)) {
            $this->crud->addField([
                'name'  => 'course_id',
                'type'  => 'hidden',
                'value' => $this->course_id,
            ], 'create');
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


            [
                'type'       => 'select2',
                'name'       => 'part_id',
                'entity'     => 'coursePart',
                'model'      => 'App\\Models\\CoursePart',
                'attribute'  => 'name',
                'label'      => trans('lang.part_of_course'),
                'options'    => (function ($query) {
                    return $query->where('course_id', $this->course_id)->get();
                }),
                'attributes' => [
                    'required' => 'required',
                ],
            ],
            [
                'name'       => 'sort',
                'type'       => 'number',
                'label'      => trans('lang.sort'),
                'attributes' => ['required' => 'required'],
            ],
            [
                'name'       => 'name',
                'type'       => 'text',
                'label'      => trans('lang.name'),
                'attributes' => ['required' => 'required'],
            ],
            [
                'name'       => 'subject_path',
                'type'       => 'url',
                'label'      => trans('lang.subject_path'),
                'attributes' => ['required' => 'required'],
            ],
            [
                'name'       => 'description',
                'type'       => 'summernote',
                'label'      => trans('lang.description'),
                'attributes' => ['required' => 'required'],
            ],
            [
                'name'       => 'kb_volume',
                'type'       => 'number',
                'attributes' => ["step" => "any", 'required' => 'required'],
                'label'      => trans('lang.kb_volume'),
            ],
            [
                'name'       => 'duration',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.duration_second'),
            ],
            [
                'name'  => 'id_free',
                'type'  => 'boolean',
                'label' => trans('lang.is_subject_free'),
            ],
            /*[
                'name'  => 'visited',
                'type'  => 'number',
                'label' => trans('lang.visited'),
            ],*/
            /*  [
                  'name'   => 'likes',
                  'prefix' => "<i class='nav-icon la la-heart'></i>",
                  'type'   => 'number',
                  'label'  => "<i class='nav-icon la la-heart'></i>".trans('lang.likes'),
              ],
              [
                  'name'  => 'dis_likes',
                  'type'  => 'number',
                  'label' => trans('lang.dis_likes'),
              ],*/

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
    protected function setupUpdateOperation() {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
