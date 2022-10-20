<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DigitalCardCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DigitalCardCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DigitalCardCategoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DigitalCardCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/digitalcardcategory');
        CRUD::setEntityNameStrings(trans('lang.digitalcardcategory'), trans('lang.digital_card_categories'));
        $this->crud->enableExportButtons();

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
      CRUD::addColumns([
          [
              'name'  => 'name',
              'type'  => 'text',
              'label' => trans('lang.name'),
          ], [
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
    protected function setupCreateOperation()
    {
        CRUD::addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ], [
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
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
