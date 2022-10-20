<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CoursePartRequest;
use App\Models\CourseTraining;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CoursePartCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CoursePartCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CoursePart::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/coursepart');
        CRUD::setEntityNameStrings(trans('lang.coursepart'), trans('lang.course_parts '));

        if ($this->parentEntity == 'coursetraining') {
            // Get the parent service
            $this->course_id = request()->segment(3);
            // Get the Parent name
            $course = CourseTraining::findOrFail($this->course_id);
            $this->crud->with(['course']);
            $this->crud->allowAccess(['parent']);
            $this->crud->setRoute(admin_uri('coursetraining/'
                .$this->course_id.'/courseParts'));
            $this->crud->addClause('where', 'course_id', '=', $this->course_id);
            $this->data['breadcrumbs'] = [
                trans('backpack::crud.admin')  => backpack_url('dashboard'),
                trans('lang.course_trainings') => backpack_url('coursetraining'),
                $course->name                  => backpack_url('coursetraining/'.$this->course_id.'/show'),
                'الاجزاء'                      => backpack_url('coursetraining/'.$this->course_id.'/courseParts'),
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
                'entity'    => 'course',
                'model'     => 'App\\Models\\CourseTraining',
                'attribute' => 'name',
                'label'     => trans('lang.course'),
            ],

            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name_part'),
            ],
            [
                'name'  => 'description',
                'type'  => 'text',
                'label' => trans('lang.description'),
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
        CRUD::setValidation(CoursePartRequest::class);
        CRUD::addFields([
            //TODO  after adding , it does not take me back , it stays at create page

            [
                'type'      => 'select2',
                'name'      => 'course_id',
                'entity'    => 'course',
                'model'     => 'App\\Models\\CourseTraining',
                'attribute' => 'name',
                'label'     => trans('lang.course'),
            ],

            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name_part'),
            ],
            [
                'name'  => 'description',
                'type'  => 'text',
                'label' => trans('lang.description'),
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
