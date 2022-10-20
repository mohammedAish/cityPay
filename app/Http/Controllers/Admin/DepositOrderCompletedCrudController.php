<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositOrderCompletedRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DepositOrderCompletedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositOrderCompletedCrudController extends DepositOrderCrudController
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
        CRUD::setModel(\App\Models\DepositOrderCompleted::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/depositordercompleted');
        CRUD::setEntityNameStrings(trans('lang.depositordercompleted'),trans('lang.deposit_order_completeds'));

        CRUD::setRoute(config('backpack.base.route_prefix').'/depositordercompleted');
        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at','desc');
        $this->crud->addClause('with','customer');
        $this->crud->addClause('where','current_status','confirmed');
        $this->crud->addClause('where','op_type','deposit');
        $this->crud->enableExportButtons();
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
