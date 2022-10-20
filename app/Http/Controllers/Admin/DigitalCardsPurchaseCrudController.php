<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DigitalCardsPurchaseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DigitalCardsPurchaseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DigitalCardsPurchaseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DigitalCardsPurchase::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/digitalcardspurchase');
        CRUD::setEntityNameStrings(trans('lang.digitalcardspurchase'), trans('lang.digital_cards_purchases'));
        if ($this->crud->getCurrentOperation() == 'list'||$this->crud->getCurrentOperation() == 'show') {
            $this->crud->addButtonFromModelFunction('line','details',
                'detailsBtn','beginning');
        }
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
        $this->crud->addColumns([
            [
                'name'  => 'purchase_date',
                'type'  => 'date',
                'label' => trans('lang.purchase_date'),
            ],

            [
                'name'  => 'total_invoice',
                'type'  => 'text',
                'label' => trans('lang.total_invoice'),
            ],
            [
                'name'       => 'currency_id',
                'entity'     => 'currency',
                'model'      => 'App\\Models\\Currency',
                'attribute'  => 'name',
                'label'      => trans('lang.currency'),

            ],
            [
                'name'  => 'description',
                'type'  => 'ckeditor',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'reference_id',
                'type'  => 'text',
                'label' => trans('lang.reference_id'),
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DigitalCardsPurchaseRequest::class);

        CRUD::addFields([
            [
                'name'  => 'purchase_date',
                'type'  => 'datetime',
                'label' => trans('lang.purchase_date'),
            ],

            [
                'name'  => 'total_invoice',
                'type'  => 'number',
                'attributes' => ["step" => "any"],
                'label' => trans('lang.total_invoice'),
            ],
            [
                'type'       => 'select2',
                'name'       => 'currency_id',
                'entity'     => 'currency',
                'model'      => 'App\\Models\\Currency',
                'attribute'  => 'name',
                'label'      => trans('lang.currency'),
                'attributes' => [
                    'placeholder' => trans('lang.currency'),
                ],
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'reference_id',
                'type'  => 'text',
                'label' => trans('lang.reference_id'),
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
    protected function setupUpdateOperation()
    {
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
