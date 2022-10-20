<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerRequest;
use App\Models\Country;
use App\Models\Customer;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Customer::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/customer');
        CRUD::setEntityNameStrings('customer', 'customers');
        CRUD::denyAccess(['create']);
        if ($this->crud->getCurrentOperation() == 'show') {
            $this->data['user'] = Customer::find(request()->segment(3));

            //$this->crud->setShowView(backpack_view('user_detail'));
            return view(backpack_view('user_detail'), $this->data);
        }

        CRUD::enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation() {
        $this->crud->addColumns([
            [
                'name'  => 'first_name',
                'type'  => 'text',
                'label' => trans('lang.first_name'),
            ],
            [
                'name'  => 'last_name',
                'type'  => 'text',
                'label' => trans('lang.last_name'),
            ],
            [
                'name'  => 'wallet_code_symbol',
                'type'  => 'text',
                'label' => trans('lang.wallet_code_symbol'),
            ], [
                'name'          => 'balanceFloat',
                'type'          => 'model_function',
                'function_name' => 'getBalanceFloatHtml',
                'sortable'      => true,
                'label'         => trans('lang.balance'),
            ], [
                'name'     => 'deposits_count',
                'type'     => 'text',
                'sortable' => true,
                'label'    => trans('lang.deposits_count'),
            ], [
                'name'     => 'withdraws_count',
                'type'     => 'text',
                'sortable' => true,
                'label'    => trans('lang.withdraws_count'),
            ],
            [
                'name'  => 'email',
                'type'  => 'email',
                'label' => trans('lang.email'),
            ],
            [
                'name'  => 'full_address',
                'type'  => 'text',
                'label' => trans('lang.address'),
            ],
            [
                'name'  => 'phone',
                'type'  => 'text',
                'label' => trans('lang.phone'),
            ],
            /*[
                'name'  => 'phone2',
                'type'  => 'text',
                'label' => trans('lang.phone2'),
            ],*/
            [
                'name'  => 'gender',
                'type'  => 'enum',
                'label' => trans('lang.gender'),
            ],
            [
                'name'  => 'birth_date',
                'type'  => 'date',
                'label' => trans('lang.birth_date'),
            ],

            /*[
                'name'  => 'account_number',
                'type'  => 'text',
                'label' => trans('lang.account_number'),
            ],*/
            //            [
            //                'name'  => 'city',
            //                'type'  => 'relationship',
            //                'label' => trans('lang.city'),
            //            ],
            [
                'name'        => 'customer_type',
                'label'       => trans('lang.customer_type'),
                'type'        => 'select_from_array',
                'options'     => [
                    'customer'   => 'عميل', 'per_consultant' => 'مستتشار تحت التجريب',
                    'consultant' => 'مستشار',
                ],
                'allows_null' => false,
            ],
            [
                'entity'    => 'badge',
                'model'     => 'App\\Models\\Badge',
                'attribute' => 'name',
                'label'     => trans('lang.badge_name'),
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],
            [
                'name'  => 'last_login_at',
                'type'  => 'date',
                'label' => trans('lang.last_login_at'),
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
    protected function setupCreateOperation() {
        CRUD::setValidation(CustomerRequest::class);

        CRUD::addFields([
            /*[
                'name'  => 'first_name',
                'type'  => 'text',
                'label' => trans('lang.first_name'),
            ],
            [
                'name'  => 'last_name',
                'type'  => 'text',
                'label' => trans('lang.last_name'),
            ],
            [
                'name'  => 'email',
                'type'  => 'email',
                'label' => trans('lang.email'),
            ],
            [
                'name'  => 'address',
                'type'  => 'text',
                'label' => trans('lang.address'),
            ],*/
            [
                'name'  => 'address2',
                'type'  => 'text',
                'label' => trans('lang.address2'),
            ],
            /*[
                'name'  => 'phone',
                'type'  => 'text',
                'label' => trans('lang.phone'),
            ],*/
            [
                'name'  => 'phone2',
                'type'  => 'text',
                'label' => trans('lang.phone2'),
            ],
            /*[
                'name'  => 'gender',
                'type'  => 'enum',
                'label' => trans('lang.gender'),
            ],
            [
                'name'  => 'birth_date',
                'type'  => 'date',
                'label' => trans('lang.birth_date'),
            ],

            [
                'name'  => 'account_number',
                'type'  => 'text',
                'label' => trans('lang.account_number'),
            ],*/
            //            [
            //                'name'  => 'city',
            //                'type'  => 'relationship',
            //                'label' => trans('lang.city'),
            //            ],

            [
                'name'        => 'customer_type',
                'label'       => trans('lang.customer_type'),
                'type'        => 'select_from_array',
                'options'     => [
                    'customer'   => 'عميل', 'per_consultant' => 'مستتشار تحت التجريب',
                    'consultant' => 'مستشار',
                ],
                'allows_null' => false,
            ],
            [
                'type'       => 'select2',
                'name'       => 'badge_id',
                // 'entity'     => 'badge',
                'model'      => 'App\\Models\\Badge',
                'attribute'  => 'name',
                'label'      => trans('lang.Badges'),
                'attributes' => [
                    'placeholder' => trans('lang.Choose_customer_badge'),
                ],
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],
            /*[
                'name'  => 'last_login_at',
                'type'  => 'date',
                'label' => trans('lang.last_login_at'),
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
    protected function setupUpdateOperation() {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);
        // $this->setupListOperation();
        $customerInfo               = Customer::find(request()->segment(3));
        $this->data['user']         = $customerInfo;
        $this->data['withdrawals']  = $customerInfo->withdrawals->count();
        $this->data['deposits']     = $customerInfo->deposits->count();
        $this->data['transactions'] = $customerInfo->deposits->count();
        $this->data['countries']    = Country::
        // whereActive(1)->
        get()->pluck('name', 'id');

        $this->crud->setShowView(backpack_view('user_detail'));
        //  return view(backpack_view('user_detail'),$this->data);
    }
}
