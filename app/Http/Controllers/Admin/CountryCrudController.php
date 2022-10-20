<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use App\Models\OrgModels\AboutCompanyPageSetting;
use App\Models\OrgModels\Counter;
use App\Models\OrgModels\PageSetup;
use App\Models\OrgModels\SiteSetting;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\View;

/**
 * Class CountryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CountryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Country::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/country');
        CRUD::setEntityNameStrings(trans('lang.country'), trans('lang.countries'));
        CRUD::denyAccess(['create', 'delete']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation() {

        CRUD::addColumn([
            'name'  => 'id',
            'type'  => 'number',
            'label' => trans("lang.id"),

        ]);
        CRUD::addColumn([
            'name'  => 'name',
            'label' => trans("lang.name"),
        ]);
        CRUD::addColumn([
            'name'  => 'code',
            'label' => trans("lang.code"),
        ]);
        CRUD::addColumn([
            'name'  => 'is_source_transferring',
            'label' => trans("lang.is_source_transferring"),
            'type'  => 'boolean',
        ]);
        CRUD::addColumn([
            'name'  => 'is_dist_transferring',
            'label' => trans("lang.is_dist_transferring"),
            'type'  => 'boolean',

        ]);
        CRUD::addColumn([
            'name'  => 'phone',
            'type'  => 'text',
            'label' => trans("lang.country_start_phone"),
        ]);
        CRUD::addColumn([
            'name'  => 'img_path',
            'type'  => 'image',
            'label' => trans("lang.country_image"),
        ]);
        CRUD::addColumn([
            'name'  => 'active',
            'type'  => 'boolean',
            'label' => trans("lang.active"),
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation() {
        CRUD::setValidation(CountryRequest::class);

        CRUD::addField([
            'name'  => 'name',
            'type'  => 'text',
            'label' => trans("lang.name"),
        ]);
        /*CRUD::addField([
            'name'  => 'is_source_transferring',
            'label' => trans("lang.is_source_transferring"),
            'type'  => 'boolean',

        ]);
        CRUD::addField([
            'name'  => 'is_dist_transferring',
            'label' => trans("lang.is_dist_transferring"),
            'type'  => 'boolean',

        ]);*/

        CRUD::addField([
            'name'  => 'img_path',
            'type'  => 'image',
            'label' => trans("lang.country_image"),
        ]);

        CRUD::addField([
            'name'  => 'active',
            'type'  => 'checkbox',
            'label' => trans("lang.active"),
        ]);
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
