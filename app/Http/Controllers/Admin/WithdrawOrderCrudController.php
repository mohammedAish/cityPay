<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WithdrawOrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WithdrawOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WithdrawOrderCrudController extends DepositOrderCrudController
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
        CRUD::setModel(\App\Models\WithdrawOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/withdraworder');
        CRUD::setEntityNameStrings(trans('lang.withdraw_completed'), trans('lang.all_withdraws'));
        $this->crud->with('agency');
        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at', 'desc');
        $this->crud->addClause('with', 'customer');
        $this->crud->addClause('where', 'op_type', 'withdraw');
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
            ], /*[
                'model'     => 'App\\Models\\CustomerFinanceAccount',
                'entity'    => 'financeAccount',
                'attribute' => 'customer_agency_acc_number',
                'label'     => trans('lang.customer_acc_number'),

            ], */


            [
                'type'  => 'text',
                'name'  => 'customer_finance_account',
                'label' => trans('lang.account-number'),
            ],

            [
                'name'          => 'financeName',
                'type'          => 'model_function',
                'function_name' => 'getFinanceAccountNammeHtml',
                'label'         => trans('lang.account-name'),
            ],

            [
                'name'    => 'order_type',
                'type'    => 'select_from_array',
                'options' => [
                    'normal_deposit'  => 'طلب ايداع مباشر',
                    'normal_withdraw' => ' طلب سحب مباشر',
                    'pull_earning'    => 'طلب ايداع -سحب ارباح',
                    'paying_order'    => 'طلب سحب - شراءاغراض من النت',
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
                'model'       => 'App\\Models\\DepositAgency',
                'entity'      => 'agency',
                'attribute'   => 'name',
                'label'       => trans('lang.agency-name'),
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('agency', function ($q) use ($column, $searchTerm) {
                        $q->where('name', 'like', '%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('withdrawagency/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'name'       => 'amount',
                'label'      => trans('lang.deposit_amount'),
            ],
            [
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
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
                'type'       => 'number',
                'name'       => 'exchange_price',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.exchange_price'),
            ],


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

        ]);
    }

    protected function setupUpdateOperation() {
        $this->setupCreateOperation();
        $this->crud->removeFields(['img_path']); //from the parent crud
        $this->crud->addFields([[
                                    'type'  => 'image',
                                    'name'  => 'img_path',
                                    'label' => trans('lang.order_image'),
                                ],]);

    }


}
