<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServicesPackageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServicesPackageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServicesPackageCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ServicesPackage::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/servicespackage');
        CRUD::setEntityNameStrings(trans('lang.servicespackage')
            ,trans('lang.services_packages'));
        CRUD::orderBy('id','asc');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        $this->crud->addColumns([
            //we will const it with one 1
           /* [
                'name'      => 'package_id',
                'model'     => 'App\\Models\\PackagesCategory',
                'entity'    => 'packageCategory',
                'attribute' => 'name',
                'label'     => trans('lang.packageServices'),
            ],*/
            [

                'entity'    => 'services',
                'model'     => 'App\\Models\\Service',
                'attribute' => 'name',
                'label'     => trans('lang.service_name'),
            ],
            //ستبقى مخفية لحين حاجتها ربما لا نحتاجها
            /*[
                'name'  => 'price',
                'type'  => 'text',
                'label' => trans('lang.price'),
            ],
            [
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
            ],
            [
                'name'  => 'discount',
                'type'  => 'text',
                'label' => trans('lang.discount'),
            ],
            */
            //deprecated
            /*[
                'name'  => 'subscription_scores',
                'type'  => 'number',
                'label' => trans('lang.subscription_scores'),
            ],*/
            [
                'name'  => 'operation_scores',
                'type'  => 'number',
                'label' => trans('lang.operation_scores'),
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
        CRUD::setValidation(ServicesPackageRequest::class);

        CRUD::addFields([
           //it is 1 by default
            /* [
                'type'      => 'select2',
                'name'      => 'package_id',
                'model'     => 'App\\Models\\PackagesCategory',
                'entity'    => 'packageCategory',
                'attribute' => 'name',
                'label'     => trans('lang.packageServices'),
            ],*/
            [
                'type'       => 'select2',
                'name'       => 'service_id',
                'entity'     => 'services',
                'model'      => 'App\\Models\\Service',
                'attribute'  => 'name',
                'label'      => trans('lang.services_list'),
                'placeholder '      => trans('lang.Choose_service_name'),
                'attributes' => [
                    'placeholder' => trans('lang.Choose_service_name'),
                ],
            ],
            //ستبقى مخفية لحين حاجتها ربما لا نحتاجها

            /* [
                 'name'  => 'price',
                 'type'  => 'number',
                 'attributes' => ["step" => "any"],
                 'label' => trans('lang.price'),
             ],
             [
                 'type'      => 'select2',
                 'name'      => 'currency_id',
                 'model'     => 'App\\Models\\Currency',
                 'entity'    => 'currency',
                 'attribute' => 'name',
                 'label'     => trans('lang.currency'),
             ],
            [
                'name'  => 'discount',
                'type'  => 'number',
                'attributes' => ["step" => "any"],
                'label' => trans('lang.discount'),
            ],
            */
            //deprecated
            /*[
                'name'  => 'subscription_scores',
                'type'  => 'number',
                'label' => trans('lang.subscription_scores'),
            ],*/
            [
                'name'  => 'operation_scores',
                'type'  => 'number',
                'label' => trans('lang.operation_scores'),
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
