<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DCardsPurchasesDetailRequest;
use App\Models\DigitalCard;
use App\Models\DigitalCardsPurchase;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DCardsPurchasesDetailCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DCardsPurchasesDetailCrudController extends CrudController
{
    protected $parentEntity;
    protected $purchase_id;
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
        CRUD::setModel(\App\Models\DCardsPurchasesDetail::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/dcardspurchasesdetail');
        CRUD::setEntityNameStrings(trans('lang.dcardspurchasesdetail'),trans('lang.d_cards_purchases_details'));

        $this->parentEntity = request()->segment(2);
        if ($this->parentEntity == 'digitalcardspurchase') {
            // Get the parent service
            $this->purchase_id = request()->segment(3);

            // Get the Parent name
            $purchase_info = DigitalCardsPurchase::findOrFail($this->purchase_id);
            $this->crud->with(['digitalCardPurchase']);
            //  $this->crud->enable();
            $this->crud->allowAccess(['parent']);
            $this->crud->setRoute(admin_uri('digitalcardspurchase/'
                .$this->purchase_id.'/dcardspurchasesdetail'));
            $this->crud->addClause('where','digital_cards_purchase_id','=',$this->purchase_id);
            $this->data['breadcrumbs'] = [
                trans('backpack::crud.admin')     => backpack_url('dashboard'),
                trans('lang.digital_cards_purchases').'('.$purchase_info->id.')'
                                                  => backpack_url('digitalcardspurchase/'.$this->purchase_id.'/show'),
                'تفاصيل الفاتورة' => backpack_url('digitalcardspurchase/'.$this->purchase_id.'/dcardspurchasesdetail'),
                trans('backpack::crud.list') => false,
            ];


        }
        $this->crud->enableExportButtons();

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
       // $this->crud->enableDetailsRow();
        $this->crud->addColumns([

            [
                'name'      => 'digital_card_id',
                'entity'    => 'digitalCard',
                'model'     => 'App\\Models\\DigitalCard',
                'attribute' => 'provider_store_package_name',//provider_store_package_name
                'label'     => trans('lang.digital_card_provider_package_name'),
                'wrapper'     => [
                    // 'element' => 'a', // the element will default to "a" so you can skip it here
                    'href' => function ($crud,$column,$entry,$related_key){
                        return backpack_url('digitalcardproviderpackage/'.$related_key.'/show');
                    },
                ],

            ],
            [
                'name'       => 'buy_price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.buy_price'),
            ],
            [
                'name'       => 'sell_price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.sell_price'),
            ],
            [
                'name'  => 'card_code',
                'type'  => 'text',
                'label' => trans('lang.card_code'),
            ],
            [
                'name'  => 'card_status',
                'type'  => 'enum',
                'label' => trans('lang.card_status'),
            ],[
                'name'  => 'expire_date',
                'type'  => 'date',
                'label' => trans('lang.expire_date'),
            ],
            [
                'name'  => 'customer_d_c_order_id',
                'type'  => 'number',
                'label' => trans('lang.customer_d_c_order_id'),
            ],

            [
                'name'  => 'assign_date',
                'type'  => 'date',
                'label' => trans('lang.assign_date'),
            ],
            [
                'name'  => 'assigned_type',
                'type'  => 'enum',
                'label' => trans('lang.assigned_type'),
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(){
        //CRUD::setValidation(DCardsPurchasesDetailRequest::class);
        if (!empty($this->purchase_id)) {
            $this->crud->addField([
                'name'  => 'digital_cards_purchase_id',
                'type'  => 'hidden',
                'value' => $this->purchase_id,
            ],'create');
        }
        $this->crud->addFields([
            [
                'type'       => 'select2',
                'name'       => 'digital_card_id',
                'entity'     => 'digitalCard',
                'model'      => 'App\\Models\\DigitalCard',
                'attribute'  => 'provider_store_package_name',//provider_store_package_name//ProviderStorePackageName
                'label'      => trans('lang.digital_card_provider_package_name'),
                'attributes' => [
                    'placeholder' => trans('lang.digital_card_provider_package_name'),
                ],
            ],
            [
                'name'       => 'buy_price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.buy_price'),
            ],
            [
                'name'       => 'sell_price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.sell_price'),
            ],
            [
                'name'  => 'card_code',
                'type'  => 'text',
                'label' => trans('lang.card_code'),
            ],
            [
                'name'  => 'expire_date',
                'type'  => 'datetime',
                'label' => trans('lang.expire_date'),
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
