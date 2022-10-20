<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositOrderRequest;
use App\Models\DepositAgencyCountry;
use App\Notifications\SendStatusChangeNotification;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DepositOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositOrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup() {
        CRUD::setModel(\App\Models\DepositOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/depositorder');
        CRUD::setEntityNameStrings(trans('lang.depositorder'), trans('lang.deposit_orders'));
        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at', 'desc');
        $this->crud->addClause('with', 'customer');
        $this->crud->addClause('where', 'op_type', '=', 'deposit');

        $this->crud->enableExportButtons();

        $this->crud->addFilter([
            'name'  => 'op_type',
            'type'  => 'dropdown',
            'label' => trans('lang.deposit_op_type'),
        ],
            ['deposit' => 'ايداع', 'withdraw' => 'سحب'],
            function ($value) {
                $this->crud->addClause('where', 'op_type', '=', $value);
            });
        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'filter_id',
            'label' => 'بحث بالرقم',
        ],
            false, function ($value) {
                $this->crud->addClause('where', 'id', '=', $value);
            });
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
                        $q->where('first_name', 'like', '%'.$searchTerm.'%')
                            ->orWhereDate('last_name', 'like', '%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/'.$related_key.'/show');
                    },
                ],
            ],


            [
                'name'    => 'order_type',
                'type'    => 'select_from_array',
                'options' => [
                    'normal_deposit'  => 'طلب ايداع مباشر',
                    'normal_withdraw' => ' طلب سحب مباشر',
                    'pull_earning'    => 'طلب ايداع -سحب ارباح',
                    'paying_order'    => 'طلب سحب -شراءاغراض من النت',
                ],
                'label'   => trans('lang.deposit_op_type'),
            ],
            [
                'type'    => 'select_from_array',
                'name'    => 'current_status',
                'options' => [
                    'pending'   => 'تحت الطلب',
                    'confirmed' => 'مكتمل ومقبول',
                    'rejected'  => 'مرفوض من الادارة',
                ],
                'label'   => trans('lang.order_status'),
            ],
            [
                'model'      => 'App\\Models\\DepositAgency',
                'entity'     => 'agency',
                'attribute'  => 'name',
                'label'      => trans('lang.agency-name'),
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('agency', function ($q) use ($column, $searchTerm) {
                        $q->where('name', 'like', '%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('depositagency/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'name'       => 'amount',
                'label'      => trans('lang.amount_wanted_to_deposit_usd'),
            ],
            [
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'name'       => 'client_amount',
                'label'      => trans('lang.amount_must_deposit'),
            ],
            [
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currencyClient',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
            ],
            [
                'name'  => 'exchange_price',
                'type'  => 'text',
                'label' => trans('lang.exchange_price'),
            ], [
                'name'          => 'fee_percent',
                // 'type'  => 'text',
                'type'          => 'model_function',
                'function_name' => 'getFeePercentHtml',
                'label'         => trans('lang.fee_percent'),
            ], [
                'name'  => 'fee_amount',
                'type'  => 'text',
                'label' => trans('lang.fee_amount'),
            ], [
                'name'  => 'final_amount',
                'type'  => 'text',
                'label' => trans('lang.final_amount'),
            ],
            [
                'name'          => 'final_amount',
                'type'          => 'model_function',
                'function_name' => 'getFreelancingPlatformHtml',
                'label'         => trans('lang.freelancingplatform_name'),
            ],
            [
                'name'  => 'created_at',
                'type'  => 'datetime',
                'label' => trans('lang.deposit_date_order'),
            ],

            /*[
                'name'  => 'created_at',
                'type'  => 'model_function',
                'function_name'  => 'getCreatedAtHtml',
                'label' => trans('lang.deposit_date_order'),
            ],*/

            [
                'type'  => 'text',
                'name'  => 'status_note',
                'label' => trans('lang.order_note'),
            ],
            [
                'type'  => 'date',
                'name'  => 'status_changed_date',
                'label' => trans('lang.deposit_date_changed'),
            ],
            [
                'type'  => 'text',
                'name'  => 'detail_statement',
                'label' => trans('lang.description'),
            ],
            [
                'type'  => 'image',
                'name'  => 'img_path',
                'label' => trans('lang.order_image'),
            ],
            [
                'type'  => 'text',
                'name'  => 'reference_id',
                'label' => trans('lang.reference_id'),
            ],
            [
                'model'     => 'App\\Models\\FreelancingPlatform',
                'entity'    => 'freelance',
                'attribute' => 'name',
                'label'     => trans('lang.freelanceing_paltform'),
            ],

        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation() {
        CRUD::setValidation(DepositOrderRequest::class);

        $this->crud->addFields([
            [
                'name'       => 'customer_id',
                'entity'     => 'customer',
                'attributes' => ['disabled' => 'disabled'],
                'model'      => 'App\\Models\\Customer',
                'attribute'  => 'name',
                'label'      => trans('lang.customer_name'),

            ],
            [
                'name'       => 'agency_id',
                'model'      => 'App\\Models\\DepositAgency',
                'entity'     => 'agency',
                'attribute'  => 'name',
                'attributes' => ['disabled' => 'disabled'],
                'label'      => trans('lang.agency-name'),
            ],

            [
                'type'       => 'number',
                'attributes' => ["step" => "any", 'required' => 'required'],
                'name'       => 'amount',
                'label'      => trans('lang.amount_wanted_to_deposit_usd'),
            ],
            [
                'type'       => 'number',
                'attributes' => ["step" => "any", 'required' => 'required'],
                'name'       => 'client_amount',
                'label'      => trans('lang.amount_must_deposit'),
            ],
            [
                'name'       => 'cl_amount_curr_id',
                'model'      => 'App\\Models\\Currency',
                'entity'     => 'currencyClient',
                'attributes' => ['required' => 'required'],
                'attribute'  => 'name',
                'label'      => trans('lang.currency'),
            ],
            [
                'type'       => 'number',
                'name'       => 'exchange_price',
                'attributes' => ["step" => "any", 'disabled' => 'disabled'],
                'label'      => trans('lang.exchange_price'),
            ],
            [
                'type'       => 'select_from_array',
                'options'    => [
                    'pending'   => 'تحت الطلب',
                    'confirmed' => 'مكتمل ومقبول',
                    'rejected'  => 'مرفوض من الادارة',
                ],
                'name'       => 'current_status',
                'attributes' => ['required' => 'required'],
                'label'      => trans('lang.order_status'),
            ],
            [
                'type'  => 'textarea',
                'name'  => 'status_note',
                'label' => trans('lang.order_note'),
            ],
            [
                'type'  => 'textarea',
                'name'  => 'detail_statement',
                'label' => trans('lang.detail_statement'),
            ],
            [
                'type'       => 'image',
                'name'       => 'img_path',
                'attributes' => ['disabled' => 'disabled'],
                'label'      => trans('lang.order_image'),
            ],
            [
                'type'  => 'text',
                'name'  => 'reference_id',
                'label' => trans('lang.reference_id'),
            ],
        ]);
        $this->crud->addField([
            'name'  => 'admin_id',
            'type'  => 'hidden',
            'value' => auth()->id(),
        ]);

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
        $this->setupListOperation();
    }

    public function update() {
        $request = $this->crud->getRequest()->request;
        $currentEntry = $this->crud->getCurrentEntry();
        $this->crud->getRequest()->request->add(['admin_id' => auth()->id()]);
        $response = $this->traitUpdate();
        $customer = $currentEntry->customer;
        if ($currentEntry->current_status != $request->get('current_status')){
            $customer->notify(new SendStatusChangeNotification($request->get('current_status')));
        }
        // do something after save
        return $response;
    }
}
