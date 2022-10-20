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
class PayingOrderCompletedCrudController extends PayingOrderCrudController
{

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup() {
        CRUD::setModel(\App\Models\PayingOrder::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/completedpayingorder');
        CRUD::setEntityNameStrings('payingorder', trans('lang.completedpayingorder'));
        CRUD::denyAccess(['create', 'delete']);

       CRUD::addClause('where', 'current_status', '=', 'order_completed');
    }

}
