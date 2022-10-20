<?php

namespace App\Http\Controllers\Admin;


use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WithdrawOrderRejectedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WithdrawOrderRejectedCrudController extends WithdrawOrderCrudController
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
        CRUD::setModel(\App\Models\WithdrawOrderRejected::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/withdraworderrejected');
        CRUD::setEntityNameStrings(trans('lang.withdraw_completed'),trans('lang.withdraw_order_rejecteds'));
        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at','desc');
        $this->crud->addClause('where','current_status','rejected');
        $this->crud->addClause('where','op_type','withdraw');
        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'filter_id',
            'label' => 'بحث بالرقم',
        ],
            false,function ($value){
                $this->crud->addClause('where','id','=',$value);
            });
    }

}
