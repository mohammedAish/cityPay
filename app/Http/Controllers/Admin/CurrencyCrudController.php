<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CurrencyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CurrencyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CurrencyCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Currency::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/currency');
        CRUD::setEntityNameStrings(trans('lang.currency'),trans('lang.Currencies'));
    }

    /**
     * Define what happens when the List operatio n is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'name_en',
                'type'  => 'text',
                'label' => trans('lang.name_en'),
            ],
            [
                'name'  => 'code',
                'type'  => 'text',
                'label' => trans('lang.code'),
            ],
           [
                'name'  => 'order',
                'label' => trans("lang.order"),
            ],
            [
                'name'  => 'symbol',
                'type'  => 'text',
                'label' => trans('lang.symbol'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ],
            [
                'name'  => 'exchange_price',
                'type'  => 'text',
                'label' => trans('lang.exchange_price'),
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
        CRUD::setValidation(CurrencyRequest::class);

        CRUD::addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'name_en',
                'type'  => 'text',
                'label' => trans('lang.name_en'),
            ],
            [
                'name'  => 'code',
                'type'  => 'text',
                'label' => trans('lang.code'),
            ],
          [
                'name'  => 'order',
                'label' => trans("lang.order"),
            ],
            [
                'name'  => 'symbol',
                'type'  => 'text',
                'label' => trans('lang.symbol'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ],
            [
                'name'       => 'exchange_price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.exchange_price'),
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
