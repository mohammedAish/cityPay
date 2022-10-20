<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DigitalCardsProviderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DigitalCardsProviderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DigitalCardsProviderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DigitalCardsProvider::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/digitalcardsprovider');
        CRUD::setEntityNameStrings(trans('lang.digitalcardsprovider'),trans('lang.digital_cards_providers'));
        if ($this->crud->getCurrentOperation() == 'list' || $this->crud->getCurrentOperation()=='show') {
            $this->crud->addButtonFromModelFunction('line','packages',
                'packagesBtn','beginning');
        }
        $this->crud->enableExportButtons();

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    /**
     * `name`, `description`, `img_path`,
     * `img_path_en`, `active`,
     */
    protected function setupListOperation(){
        $this->crud->addColumns([


            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.provider_name'),
            ],
            [
                'name'  => 'category',
                'type'  => 'relationship',
                'label' => trans('lang.provider_category'),

            ],
            [
                'name'  => 'short_desc',
                'type'  => 'text',
                'label' => trans('lang.short_dec'),
            ],[
                'name'  => 'description',
                'type'  => 'text',
                'label' => trans('lang.provider_desc'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],

            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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
        CRUD::setValidation(DigitalCardsProviderRequest::class);

        CRUD::addFields([

            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.provider_name'),
            ],
            [
                'type'       => 'select2',
                'name'       => 'category_id',
                'entity'     => 'category',
                'model'      => 'App\\Models\\DigitalCardCategory',
                'attribute'  => 'name',
                'label'      => trans('lang.provider_category'),
                'attributes' => [
                    'placeholder' => trans('lang.provider_category'),
                ],
            ],
            [
                'name'  => 'short_desc',
                'type'  => 'text',
                'label' => trans('lang.short_dec'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.provider_desc'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],

            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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
