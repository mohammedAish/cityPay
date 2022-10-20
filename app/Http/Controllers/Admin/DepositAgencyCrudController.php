<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositAgencyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class DepositAgencyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositAgencyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    /*  use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
      use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
     */
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     * @throws \Exception
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\DepositAgency::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/depositagency');
        CRUD::setEntityNameStrings(trans('lang.depositagency'), trans('lang.deposit_agencies'));

      /*  if ($this->crud->getCurrentOperation() == 'list' ||
            $this->crud->getCurrentOperation() == 'show') {
            $this->crud->addButtonFromModelFunction('line', 'packages',
                'depositAgencyFeeBtn', 'beginning');
        }*/
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
                'name' => 'name',
                'type' => 'text',
                'label' => trans('lang.name'),
            ], [
                'name' => 'national',
                'type' => 'select_from_array',
                'options' => [
                    'national' => 'محلية',
                    'international' => 'عالمية',
                ],
                'label' => trans('lang.national'),
            ], [
                'name' => 'is_withdraw_agency',
                'type' => 'boolean',
                'label' => trans('lang.is_withdraw_agency'),
            ],


            [
                'label' => trans('lang.countires'),
                'name' => 'countries',
                'type' => 'relationship',
            ],

            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => trans('lang.description_agency'),
            ],
         /*   [
                'name' => 'depositMethod',
                'type' => 'relationship',
                'label' => trans('lang.deposit_system'),
            ],*/
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
                'name' => 'phone',
                'type' => 'text',
                'label' => trans('lang.phone'),
            ], [
                'name' => 'address',
                'type' => 'text',
                'label' => trans('lang.address'),
            ], [
                'name' => 'img_path',
                'type' => 'image',
                'label' => trans('lang.badge_image'),
            ],
            [
                'name' => 'active',
                'type' => 'boolean',
                'label' => trans('lang.active'),
            ],
            [
                'name' => 'ytadawul_account_number',
                'type' => 'text',
                'label' => trans('lang.ytadawul_account_number'),
            ], [
                'name' => 'ytadawul_account_name',
                'type' => 'text',
                'label' => trans('lang.ytadawul_account_name'),
            ], [
                'name' => 'deposit_fee_percent',
                'type' => 'text',
                'label' => trans('lang.deposit_fee_percent'),
            ],
            [
                'name' => 'fixed_charge_deposit',
                'type' => 'text',
                'label' => trans('lang.fixed_charge_deposit'),
            ],
            [
                'name' => 'min_deposit_amount',
                'type' => 'text',
                'label' => trans('lang.min_deposit_amount'),
            ], /*[
                'name' => 'max_deposit_amount',
                'type' => 'text',
                'label' => trans('lang.max_deposit_amount'),
            ],*/
            ['type'          => 'model_function',
            'function_name' => 'getMaxDepositAmountHtml',
            'name'          => 'max_deposit_amount',
            'label'         => trans('lang.max_deposit_amount'),

        ],
            [
                'name' => 'deposit_instructions',
                'type' => 'markdown',
                'label' => trans('lang.deposit_instructions'),
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
        CRUD::setValidation(DepositAgencyRequest::class);
        $this->crud->addFields([
            [
                'name' => 'name',
                'attributes' => ['required' => 'required'],
                'type' => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name' => 'national',
                'type' => 'select_from_array',
                'options' => [
                    'national' => 'محلية',
                    'international' => 'عالمية',
                ],

                'label' => trans('lang.national'),
            ],
            [
                'name' => 'is_withdraw_agency',
                'type' => 'boolean',
                'label' => trans('lang.is_withdraw_agency'),
            ],
         /*   [
                'name' => 'depositMethods',
                'type' => 'relationship',
                'attributes' => ["required" => "required"],
                'label' => trans('lang.deposit_system'),
            ],*/
            [
                'name'       => 'deposit_method_id',
                'entity'     => 'depositMethod',
                'model'      => 'App\\Models\\DepositMethod',
                'attribute'  => 'name',
                'label'      => trans('lang.deposit_system'),

            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => trans('lang.description_agency'),
            ],
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => trans('lang.phone'),
            ], [
                'name' => 'address',
                'type' => 'textarea',
                'label' => trans('lang.address'),
            ], [
                'name' => 'img_path',
                'type' => 'image',
                'label' => trans('lang.badge_image'),
            ],
            [
                'label' => trans('lang.countires'),
                'name' => 'countries',
                'attributes' => ['required' => 'required'],
                'type' => 'relationship',
            ],
            [
                'name' => 'active',
                'type' => 'boolean',
                'label' => trans('lang.active'),
            ],

            [
                'name' => 'ytadawul_account_number',
                'type' => 'text',
                'attributes' => ['required' => 'required'],
                'label' => trans('lang.ytadawul_account_number'),
            ], [
                'name' => 'ytadawul_account_name',
                'type' => 'text',
                'attributes' => ['required' => 'required'],
                'label' => trans('lang.ytadawul_account_name'),
            ], [
                'name' => 'deposit_fee_percent',
                'type' => 'number',
                'attributes' => ['required' => 'required','step'=>'any'],
                'label' => trans('lang.deposit_fee_percent'),
            ],
            [
                'name' => 'fixed_charge_deposit',
                'type' => 'number',
                'attributes' => ['step'=>'any'],
                'label' => trans('lang.fixed_charge_deposit'),
            ],
            [
                'name' => 'min_deposit_amount',
                'type' => 'number',
                'attributes' => ['required' => 'required','step'=>'any'],
                'label' => trans('lang.min_deposit_amount'),
            ], [
                'name' => 'max_deposit_amount',
                'type' => 'number',
                'label' => trans('lang.max_deposit_amount'),
                'attributes' => ['required' => 'required','step'=>'any'],
            ], [
                'name' => 'deposit_instructions',
                'type' => 'summernote',
                'label' => trans('lang.deposit_instructions'),
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

    /**
     * Define what happens when the show operation is loaded.
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $posted = $this->crud->getStrippedSaveRequest();
        /*$methods = $posted['depositMethods'];
        if (count($methods) > 1) {
            Alert::error('يجب ان تكون الوكالة تبع نظام واحد فقط')->flash();
            return redirect()->back()->withInput();
        }*/
        $countries=     $posted['countries'];
        if (count($countries) > 1) {
            Alert::error('يجب ان تكون الوكالة في دولة واحدة فقط')->flash();
            return redirect()->back()->withInput();
        }
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation(); // validation has already been run
        return $this->traitStore();
    }

    public function checkPosted()
    {
       /* $posted = $this->crud->getStrippedSaveRequest();
        $methods = $posted['depositMethods'];
        if (count($methods) > 1) {
            Alert::error('يجب ان تكون الوكالة تبع نظام واحد فقط')->flash();
            return redirect()->back()->withInput();
        }*/

    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update()
    {
        $posted = $this->crud->getStrippedSaveRequest();
        /*$methods = $posted['depositMethods']??[];
        if (count($methods) > 1) {
            Alert::error('يجب ان تكون الوكالة تبع نظام واحد فقط')->flash();
            return redirect()->back()->withInput();
        }*/
        $countries=     $posted['countries']??[];
        if (count($countries) > 1) {
            Alert::error('يجب ان تكون الوكالة في دولة واحدة فقط')->flash();
            return redirect()->back()->withInput();
        }
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation(); // validation has already been run
        return $this->traitUpdate();
    }
}
