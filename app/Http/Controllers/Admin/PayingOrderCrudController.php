<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PayingOrderRequest;
use App\Models\PayingOrder;
use App\Models\Traits\WalletModelTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Arr;
use Prologue\Alerts\Facades\Alert;

/**
 * Class PayingOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PayingOrderCrudController extends CrudController
{
    use WalletModelTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup() {
        CRUD::setModel(\App\Models\PayingOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/payingorder');
        CRUD::setEntityNameStrings('payingorder', 'paying_orders');
        CRUD::denyAccess(['create', 'delete']);
       // $this->crud->getModel()->toArray();
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
                'name'       => 'customer_id',
                'entity'     => 'customer',
                'attributes' => ['disabled' => 'disabled'],
                'model'      => 'App\\Models\\Customer',
                'attribute'  => 'name',
                'label'      => trans('lang.customer_name'),
                'wrapper'    => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/'.$related_key.'/show');
                    },
                ],

            ],
            [
                'name'  => 'product_name',
                'type'  => 'text',
                'label' => trans('lang.product-name'),
            ], [
                'name'  => 'paying_date',
                'type'  => 'datetime',
                'label' => trans('lang.paying_date'),
            ],
            [
                'type'    => 'select_from_array',
                'options' => [
                    'pending'           => 'تحت الطلب',
                    'order_accepted'    => '2- تم القبول من الادارة',
                    'customer_canceled' => 'تم الغاءه من قبل العميل',
                    'admin_rejected'    => 'مرفوض من الادارة',
                    'in_processing'     => '3- تحت المعالحة',
                    'order_completed'   => '4-مكتمل',
                    'canceled_by_admin' => 'تم الغاءه من قبل العميل',
                ],
                'name'    => 'current_status',
                'label'   => trans('lang.current_status'),
            ],
            [
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'name'       => 'product_price',
                'label'      => trans('lang.product_cl_price'),
            ], [
                'type'       => 'text',
                'attributes' => ["step" => "any"],
                'name'       => 'description',
                'label'      => trans('lang.product-desc'),
            ], [
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'name'       => 'real_price',
                'label'      => trans('lang.real_price'),
            ],

            [
                'name'      => 'currency_id',
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
            ],


            [
                'type'       => 'number',
                'name'       => 'commission_percent',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.commission_percent'),
            ], [
                'type'       => 'number',
                'name'       => 'commission_fee',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.commission_fee'),
            ], [
                'type'       => 'number',
                'name'       => 'final_price',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.final_price'),
            ], [
                'type'  => 'text',
                'name'  => 'link_url',
                'label' => trans('lang.product-link'),
            ], [
                'type'  => 'image',
                'name'  => 'file_path',
                'label' => trans('lang.image'),
            ], [
                'type'  => 'text',
                'name'  => 'admin_note',
                'label' => trans('lang.admin_note'),
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
                'name'       => 'product_name',
                'type'       => 'text',
                'attributes' => ['disabled' => 'disabled'],

                'label' => trans('lang.product-name'),
            ], [
                'name'       => 'paying_date',
                'type'       => 'datetime',
                'attributes' => ["required" => "required"],
                'label'      => trans('lang.paying_date'),
            ],
            [
                'type'       => 'number',
                'attributes' => ["step" => "any", 'disabled' => 'disabled'],
                'name'       => 'product_price',

                'label' => trans('lang.product_cl_price'),
            ],

            [
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'name'       => 'real_price',

                'label' => trans('lang.real_price'),
            ], [
                'type'       => 'text',
                'attributes' => ["step" => "any"],
                'name'       => 'description',
                'label'      => trans('lang.product-desc'),
            ],
            [
                'name'      => 'currency_id',
                'model'     => 'App\\Models\\Currency',
                'entity'    => 'currency',
                'attribute' => 'name',
                'label'     => trans('lang.currency'),
            ],
            [
                'type'       => 'number',
                'name'       => 'commission_percent',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.commission_percent'),
            ], [
                'type'       => 'number',
                'name'       => 'commission_fee',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.commission_fee'),
            ],


            [
                'type'    => 'select_from_array',
                'options' => [
                    'pending'           => 'تحت الطلب',
                    'order_accepted'    => '2- تم القبول من الادارة',
                    'customer_canceled' => 'تم الغاءه من قبل العميل',
                    'admin_rejected'    => 'مرفوض من الادارة',
                    'in_processing'     => '3- تحت المعالحة',
                    'order_completed'   => '4-مكتمل',
                    'canceled_by_admin' => 'تم الغاءه من قبل العميل',
                ],
                'name'    => 'current_status',
                'label'   => trans('lang.current_status'),
            ], [
                'type'       => 'text',
                'name'       => 'link_url',
                'attributes' => ['disabled' => 'disabled'],
                'label'      => trans('lang.product-link'),
            ], [
                'type'       => 'image',
                'name'       => 'file_path',
                'attributes' => ['disabled' => 'disabled'],
                'label'      => trans('lang.image'),
            ], [
                'type'  => 'text',
                'name'  => 'admin_note',
                'label' => trans('lang.admin_note'),
            ],
        ]);
        $this->crud->addField([
            'name'  => 'admin_id',
            'type'  => 'hidden',
            'value' => auth()->id(),
        ]);
        $this->crud->addField([
            'name'  => 'last_edited_by',
            'type'  => 'hidden',
            'value' => 'admin',
        ]);
        $this->crud->addField([
            'name'  => 'final_price',
            'type'  => 'hidden',
            'value' => 0,
        ]);
        $this->crud->addField([
            'name'  => 'product_price',
            'type'  => 'hidden',
            'value' => 0,
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation() {
        //  CRUD::setValidation(PayingOrderRequest::class);

        $this->setupCreateOperation();
    }

    public function update() {
        $request = $this->crud->validateRequest();
        // update the row in the db
        $posted        = $this->crud->getStrippedSaveRequest();
        $keyValue      = $request->get($this->crud->model->getKeyName());
        $originalModel = PayingOrder::findOrFail($keyValue);

        if ($originalModel->current_status === 'order_completed' && $posted['current_status'] != 'order_completed') {
            Alert::error('لا يمكن تعديل الحالة بعد الاكتمال')->flash();

            return redirect()->back()->withInput();
        }

        //if was accepted and want to be pending
        if ($originalModel->current_status === 'order_accepted' && $posted['current_status'] != 'pending') {
            if (isset($originalModel->withdraw_id) && $originalModel->withdraw_id > 0) {
                Alert::error('هناك يالفعل قبول لهذا الطلب وقد ارتبط برقم سحب ولا يمكن ارجاعة للحالة السابقة '.$originalModel->withdraw_id)->flash();

                return redirect()->back()->withInput();
            }

        }

        //if want to accepted and must check if was accepted before
        if ($originalModel->current_status != 'in_processing' && $posted['current_status'] == 'in_processing') {

            if ($this->checkIsThereRelatedWithdrawl($originalModel, $posted)) {
                Alert::error('هناك يالفعل قبول لهذا الطلب وقد ارتبط برقم سحب '.$originalModel->withdraw_id)->flash();

                return redirect()->back()->withInput();
            }
        }
        //if want to return to accepting or pending after withdraw
        if ($originalModel->current_status == 'in_processing' &&
            in_array($posted['current_status'], ['order_accepted', 'pending'])) {
            if ($this->checkIsThereRelatedWithdrawl($originalModel, $posted)) {
                Alert::error('هناك يالفعل قبول لهذا الطلب وقد ارتبط برقم سحب '.$originalModel->withdraw_id)->flash();

                return redirect()->back()->withInput();
            }
        }
        //if want to canceled by admin after accepting then return the wallet balance
        if (in_array($originalModel->current_status, ['canceled_by_admin', 'customer_canceled', 'admin_rejected']) &&
            $this->checkIsThereRelatedWithdrawl($originalModel, $posted)) {
            //re deposit
            $this->doReDepositTheWithdrawal($originalModel->withdraw_id, $originalModel->customer_id);
        }

        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation(); // validation has already been run*/


        //set the product price
        $posted['product_price'] = isset($posted['real_price']) ? $posted['real_price'] : $posted['product_price'];
        $final_price             = $posted['product_price'] + ($posted['product_price'] * $posted['commission_percent']);

        $this->crud->getRequest()->request->add(['product_price' => $posted['product_price']]);
        $this->crud->getRequest()->request->add(['final_price' => $final_price]);

        //final do the withdrawal before accept the paying_order
        //todo ZAHER complete the withdraw op
        return $this->traitUpdate();
    }

    public function checkIsThereRelatedWithdrawl(PayingOrder $payingOrder, $posted_date) {

        if (isset($payingOrder->withdraw_id) && $payingOrder->withdraw_id > 0) {
            //  Alert::error('هناك يالفعل قبول لهذا الطلب وقد ارتبط برقم سحب '.$payingOrder->withdraw_id)->flash();
            return true;
        }

        return false;

    }
    //كيف سيتم تخديد العمولة  هل ثابته من خصائص النظام  ام لكل عملية شراء هناك عمولة
    // هل يتم تحديد العمولة لكي تظهر للعميل لكي يتقبلها اذا كان لكل عملية عمولة  ام تظهر له العمولة وقت الطلب
    //الخطوات الافضل كالتالي
    //الزبون يطلب
    //الادمن يقوم بعمل تتأكيد بالسعر الحقيقي مع العمولة
    //الزبون يؤكد القبول
    //الادمن يقوم بعمل اكمال للطلب وسحب المبلغ

}
