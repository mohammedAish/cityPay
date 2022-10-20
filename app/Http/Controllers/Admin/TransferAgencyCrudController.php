<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransferAgencyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransferAgencyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransferAgencyCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TransferAgency::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/transferagency');
        CRUD::setEntityNameStrings(trans('lang.transferagency'),trans('lang.transfer_agencies'));
        CRUD::orderBy('id','asc');
        if ($this->crud->getCurrentOperation() == 'list' ||
            $this->crud->getCurrentOperation() == 'show') {
            $this->crud->addButtonFromModelFunction('line','packages',
                'transferAgencyFeeBtn','beginning');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    /**
     * Define what happens when the List operation is loaded.
     * `agency_name`, `agency_desc`, `img_path`,
     * `receive_method`, `active`,
     */
    protected function setupListOperation(){
        $this->crud->addColumns([
            [
                'name'  => 'agency_name',
                'type'  => 'text',
                'label' => trans('lang.agency_name'),
            ],

            [
                'name'  => 'agency_desc',
                'type'  => 'markdown',
                'label' => trans('lang.agency_desc'),
            ],
            [
                'name'    => 'receive_method',
                'type'    => 'select_from_array',
                'options' => [
                    'both'   => 'كاش وعبر المحفظة',
                    'cash'   => 'كاش',
                    'wallet' => 'محفظة',
                ],
                'label'   => trans('lang.receive_method'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),

            ],
            [
                'label' => trans('lang.countires'),
                'name'  => 'countries',
                'type'  => 'relationship',
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
        CRUD::setValidation(TransferAgencyRequest::class);

        CRUD::addFields([
            [
                'name'  => 'agency_name',
                'type'  => 'text',
                'label' => trans('lang.agency_name'),
            ],

            [
                'name'  => 'agency_desc',
                'type'  => 'ckeditor',
                'label' => trans('lang.agency_desc'),
            ],
            [
                'name'    => 'receive_method',
                'type'    => 'select_from_array',
                'options' => [
                    'both'   => 'كاش وعبر المحفظة',
                    'cash'   => 'كاش',
                    'wallet' => 'محفظة',
                ],
                'label'   => trans('lang.receive_method'),
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),

            ],

            [
                'label' => trans('lang.countires'),
                'name'  => 'countries',
                'type'  => 'relationship',
            ],
            [
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
