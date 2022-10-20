<?php

namespace App\Http\Controllers\Admin;


use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WithdrawAgencyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WithdrawAgencyCrudController extends DepositAgencyCrudController
{


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\WithdrawAgency::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/withdrawagency');
        CRUD::setEntityNameStrings(trans('lang.withdrawagency'), trans('lang.withdraw_agencies'));

        /* if ($this->crud->getCurrentOperation() == 'list' ||
             $this->crud->getCurrentOperation() == 'show') {
             $this->crud->addButtonFromModelFunction('line','packages',
                 'depositAgencyFeeBtn','beginning');
         }*/
        $this->crud->addClause('where', 'is_withdraw_agency', '=', 1);
        /*        $this->crud->denyAccess(['create', 'delete']);*/

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
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ], [
                'name'    => 'national',
                'type'    => 'select_from_array',
                'options' => [
                    'national'      => 'محلية',
                    'international' => 'عالمية',
                ],
                'label'   => trans('lang.national'),
            ],
            [
                'label' => trans('lang.countires'),
                'name'  => 'countries',
                'type'  => 'relationship',
            ],
            [
                'model'       => 'App\\Models\\DepositMethod',
                'entity'      => 'depositMethod',
                'attribute'   => 'name',
                'label'       => trans('lang.deposit_system'),
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('depositMethod', function ($q) use ($column, $searchTerm) {
                        $q->where('name', 'like', '%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('depositmethod/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description_agency'),
            ],
            [
                'name'  => 'phone',
                'type'  => 'text',
                'label' => trans('lang.phone'),
            ], [
                'name'  => 'address',
                'type'  => 'text',
                'label' => trans('lang.address'),
            ], [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.badge_image'),
            ],


            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
            ],
            [
                'name'  => 'withdraw_fee_percent',
                'type'  => 'text',
                'label' => trans('lang.withdraw_fee_percent'),
            ],
            [
                'name'  => 'fixed_charge_withdraw',
                'type'  => 'text',
                'label' => trans('lang.fixed_charge_withdraw'),
            ],
            [
                'name'  => 'min_withdraw_amount',
                'type'  => 'text',
                'label' => trans('lang.min_withdraw_amount'),
            ],/* [
                'name'  => 'max_withdraw_amount',
                'type'  => 'text',
                'label' => trans('lang.max_withdraw_amount'),
            ],*/

            [
                'type'          => 'model_function',
                'function_name' => 'getMaxWithdrawAmountHtml',
                'name'          => 'max_withdraw_amount',
                'label'         => trans('lang.max_withdraw_amount'),

            ],[
                'name'  => 'withdraw_instructions',
                'type'  => 'markdown',
                'label' => trans('lang.withdraw_instructions'),
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        $this->crud->addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'attributes' => ['required' => 'required'],
                'label' => trans('lang.name'),
            ],
            [
                'name'    => 'national',
                'type'    => 'select_from_array',
                'options' => [
                    'national'      => 'محلية',
                    'international' => 'عالمية',
                ],
                'attributes' => ['required' => 'required'],
                'label'   => trans('lang.national'),
            ],
            /* [
                 'name' => 'depositMethods',
                 'type' => 'relationship',
                 'attributes' => ["required" => "required"],
                 'label' => trans('lang.withdraw_system'),
             ],*/
            /* [
                 'name' => 'description',
                 'type' => 'textarea',
                 'label' => trans('lang.description_agency'),
             ],*/
            /* [
                 'name' => 'phone',
                 'type' => 'text',
                 'label' => trans('lang.phone'),
             ], [
                 'name' => 'address',
                 'type' => 'textarea',
                 'label' => trans('lang.address'),
             ], */ [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.badge_image'),
            ],
            /* [
                 'label' => trans('lang.countires'),
                 'name' => 'countries',
                 'type' => 'relationship',
             ],
             [
                 'name' => 'active',
                 'type' => 'boolean',
                 'label' => trans('lang.active'),
             ],*/
            [
                'name'       => 'withdraw_fee_percent',
                'type'       => 'number',
                'attributes' => ['required' => 'required', 'step' => 'any'],
                'label'      => trans('lang.withdraw_fee_percent'),
            ],
            [
                'name'       => 'fixed_charge_withdraw',
                'type'       => 'number',
                'attributes' => ['step' => 'any'],
                'label'      => trans('lang.fixed_charge_withdraw'),
            ],
            [
                'name'       => 'min_withdraw_amount',
                'type'       => 'number',
                'attributes' => ['required' => 'required', 'step' => 'any'],
                'label'      => trans('lang.min_withdraw_amount'),
            ], [
                'name' => 'max_withdraw_amount',
                'type' => 'number',
                'attributes' => ['required' => 'required', 'step' => 'any'],
                'label' => trans('lang.max_withdraw_amount'),
            ],


            [
                'name'  => 'withdraw_instructions',
                'type'  => 'summernote',
                'label' => trans('lang.withdraw_instructions'),
            ],


        ]);


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
