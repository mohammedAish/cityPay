<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WalletTransferRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WalletTransferCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WalletTransferCrudController extends CrudController
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
        CRUD::setModel(\App\Models\WalletTransfer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/wallettransfer');
        CRUD::setEntityNameStrings('wallettransfer', 'wallet_transfers');
        CRUD::denyAccess(['create', 'delete', 'update']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        CRUD::setFromDb(); // columns

        $this->crud->addColumns([

                [
                    'type'        => 'number',
                    'name'        => 'id',
                    'label'       => trans('lang.id'),
                    'searchLogic' => function ($query, $column, $searchTerm) {
                        $query->orWhere('id', '=', $searchTerm);
                    },
                ],
                [
                    'model'       => 'App\\Models\\Customer',
                    'entity'      => 'customer',
                    'attribute'   => 'name',
                    'label'       => trans('lang.customer_name'),
                    'searchLogic' => function ($query, $column, $searchTerm) {
                        $query->orWhereHas('customer', function ($q) use ($column, $searchTerm) {
                            $q->where('first_name', 'like', '%' . $searchTerm . '%')
                                ->orWhereDate('last_name', 'like', '%' . $searchTerm . '%');
                        });
                    },
                    'wrapper'     => [
                        'href' => function ($crud, $column, $entry, $related_key) {
                            return backpack_url('customer/' . $related_key . '/show');
                        },
                    ],
                ],
                [
                    'name' => 'amount',
                ],
                [
                    'name' => 'fee',
                ],
                [
                    'name' => 'final_amount',
                ],
                [
                    'name' => 'status',
                    'type' => 'custom_status2'
                ],
            ]
        );
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
        CRUD::setValidation(WalletTransferRequest::class);

        CRUD::setFromDb(); // fields

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
}
