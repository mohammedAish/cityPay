<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LanguageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LanguageCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Language::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/language');
        CRUD::setEntityNameStrings(trans('lang.Language'),trans('lang.Languages'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        /*
         * `abbr`, `locale`, `name`, `local_name`, `flag`, `direction`,
         *  `date_format`, `datetime_format`, `active`, `default`, `lft`, `rgt`
         */
       CRUD::addColumns([
            [
                'name'  => 'abbr',
                'type'  => 'text',
                'label' => trans('lang.abbr'),
            ],[
                'name'  => 'locale',
                'type'  => 'text',
                'label' => trans('lang.locale'),
            ],[
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],[
                'name'  => 'direction',
                'type'  => 'text',
                'label' => trans('lang.direction'),
            ],[
                'name'  => 'default',
                'type'  => 'boolean',
                'label' => trans('lang.default'),
            ],[
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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
        CRUD::setValidation(LanguageRequest::class);
        CRUD::addFields([
            [
                'name'  => 'abbr',
                'type'  => 'text',
                'label' => trans('lang.abbr'),
            ],[
                'name'  => 'locale',
                'type'  => 'text',
                'label' => trans('lang.locale'),
            ],[
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],[
                'name'  => 'direction',
                'type'  => 'text',
                'label' => trans('lang.direction'),
            ],
            [
                'name'  => 'default',
                'type'  => 'boolean',
                'label' => trans('lang.default'),
            ],[
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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
        $this->setupListOperation();
    }
}
