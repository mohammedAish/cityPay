<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceInstructionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceInstructionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServiceInstructionCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ServiceInstruction::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/serviceinstruction');
        CRUD::setEntityNameStrings('serviceinstruction','service_instructions');
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
                'name'  => 'service_name',
                'type'  => 'text',
                'label' => trans('lang.parent_service'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.feature_description'),
            ],[
                'name'  => 'steps',
                'type'  => 'enum',
                'label' => trans('lang.feature_description'),
            ],[
                'name'  => 'instructions',
                'type'  => 'textarea',
                'label' => trans('lang.feature_description'),
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
        $this->crud->addFields([
            [
                'name'  => 'service_name',
                'type'  => 'text',
                'label' => trans('lang.parent_service'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.feature_description'),
            ],[
                'name'  => 'steps',
                'type'  => 'enum',
                'label' => trans('lang.feature_description'),
            ],[
                'name'  => 'instructions',
                'type'  => 'summernote',
                'label' => trans('lang.feature_description'),
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
}
