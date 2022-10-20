<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositOrderSuspendedRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DepositOrderSuspendedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositOrderSuspendedCrudController extends DepositOrderCrudController
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
    public function setup(){
        CRUD::setModel(\App\Models\DepositOrderSuspended::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/depositordersuspended');
        CRUD::setEntityNameStrings(trans('lang.depositordersuspended'),
            trans('lang.deposit_order_suspendeds'));
        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at','desc');
        $this->crud->addClause('where','current_status','pending');
        $this->crud->addClause('where','op_type','deposit');
        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'filter_id',
            'label' => 'بحث بالرقم',
        ],
            false,function ($value){
                $this->crud->addClause('where','id','=',$value);
            });

        if ($this->crud->getCurrentOperation() == 'list') {
            CRUD::denyAccess(['delete']);
        }
    }


}
