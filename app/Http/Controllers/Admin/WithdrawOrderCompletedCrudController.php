<?php

namespace App\Http\Controllers\Admin;


use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WithdrawOrderCompletedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WithdrawOrderCompletedCrudController extends WithdrawOrderCrudController
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
        CRUD::setModel(\App\Models\WithdrawOrderCompleted::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/withdrawordercompleted');
        CRUD::setEntityNameStrings(trans('lang.withdraw_completed'),trans('lang.withdraw_order_completed'));

        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at','desc');
        $this->crud->addClause('where','current_status','confirmed');
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
