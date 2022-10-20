<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FreelancingPlatformRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FreelancingPlatformCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FreelancingPlatformCrudController extends CrudController
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
    public function setup() {
        CRUD::setModel(\App\Models\FreelancingPlatform::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/freelancingplatform');
        CRUD::setEntityNameStrings(trans('lang.freelancingplatform'), trans('lang.FreelancingPlatforms'));
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
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ], [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.badge_image'),
            ],
            [
                'name'  => 'depositAgencies',
                'type'  => 'relationship',
                'label' => trans('lang.depositAgencies'),
            ],

        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation() {
        CRUD::setValidation(FreelancingPlatformRequest::class);
        $this->crud->addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ], [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.badge_image'),
            ],
            [
                'name'    => 'depositAgencies',
                'type'    => 'relationship',
                'label'   => trans('lang.depositAgencies'),
                'options' => (function ($query) {
                    return $query->where('national', 'international')->get();
                }),
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

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }
}
