<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransferWithdrawOrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransferWithdrawOrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransferWithdrawOrderAcceptedCrudController extends TransferWithdrawOrderCrudController
{

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\TransferWithdrawOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transferwithdrawordercompleted');
        CRUD::setEntityNameStrings('transferwithdraworder', 'transfer_withdraw_orders');
        CRUD::addClause('where','current_status','confirmed');
        CRUD::denyAccess(['create', 'delete']);

    }


}
