<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DepositOrderRejectedRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DepositOrderRejectedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DepositOrderRejectedCrudController extends DepositOrderCrudController
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
        CRUD::setModel(\App\Models\DepositOrderRejected::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/depositorderrejected');

        CRUD::setEntityNameStrings(trans('lang.depositorderrejected'),
            trans('lang.deposit_order_rejecteds'));
        CRUD::denyAccess(['create']);
        CRUD::orderBy('created_at','desc');
        $this->crud->addClause('where','current_status','rejected');
        $this->crud->addClause('where','op_type','deposit');
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
