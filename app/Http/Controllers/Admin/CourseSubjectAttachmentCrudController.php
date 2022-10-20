<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseSubjectAttachmentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseSubjectAttachmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseSubjectAttachmentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CourseSubjectAttachment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/coursesubjectattachment');
        CRUD::setEntityNameStrings('coursesubjectattachment', 'course_subject_attachments');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    /**
    `subject_id`, `name`, `subject_path`,
     * `description`, `subject_type
     */
    protected function setupListOperation()
    {
        //`id`, `course_id`, `name`, `description`,
        $this->crud->addColumns([
            [
                'name'  => 'courseSubject',
                'type'  => 'relationship',
                'label' => trans('lang.courseSubject'),
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
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'subject_type',
                'type'  => 'enum',
                'label' => trans('lang.subject_type'),
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
        CRUD::setValidation(CourseSubjectAttachmentRequest::class);
        CRUD::addFields([
            [
                'name'  => 'courseSubject',
                'type'  => 'relationship',
                'label' => trans('lang.courseSubject'),
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
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'subject_type',
                'type'  => 'enum',
                'label' => trans('lang.subject_type'),
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
