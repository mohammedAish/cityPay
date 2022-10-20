<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DigitalCardRequest;
use App\Models\Currency;
use App\Models\DigitalCardsProvider;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DigitalCardCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DigitalCardCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DigitalCard::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/digitalcard');
        CRUD::setEntityNameStrings('digitalcard','digital_cards');

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
                'name'      => 'provider',
                'type'      => 'relationship',
                'label'     => trans('lang.provider_name'),
                'attribute' => 'name',

            ],[
                'name'  => 'store',
                'type'  => 'relationship',
                'label' => trans('lang.store_name'),
            ],
            [
                'name'  => 'providerPackage',
                'type'  => 'relationship',
                'label' => trans('lang.package_name'),
            ],
            [
                'type'          => 'model_function',
                'function_name' => 'getProviderPackageNameHtml',
                'name'          => 'd_c_package_id',
                'label'         => trans('lang.provider_package_name'),

            ],
            /*[
                //deprecated
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],*/

            /*[
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],*/
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
        CRUD::setValidation(DigitalCardRequest::class);

        CRUD::addFields([
            /*[
                'type'       => 'select2',
                'name'       => 'provider_id',
                'entity'     => 'provider',
                'model'      => 'App\\Models\\DigitalCardsProvider',
                'attribute'  => 'name',
                'label'      => trans('lang.provider_name'),
                'attributes' => [
                    'placeholder' => trans('lang.provider_name'),
                ],
            ],[
                'type'       => 'select2',
                'name'       => 'store_id',
                'entity'     => 'store',
                'model'      => 'App\\Models\\DigitalCardStore',
                'attribute'  => 'name',
                'label'      => trans('lang.store_name'),
                'attributes' => [
                    'placeholder' => trans('lang.store_name'),
                ],
            ],*/[
                'type'       => 'select2',
                'name'       => 'd_c_package_id',
                'entity'     => 'providerPackageDistinct',
                'model'      => 'App\\Models\\DigitalCardProviderPackage',
                'attribute'  => 'provider_store_package_name',
                'label'      => trans('lang.provider_package_name'),
                'attributes' => [
                    'placeholder' => trans('lang.provider_package_name'),
                ],
            ],
            /*[
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],*/

            /*[
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
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
