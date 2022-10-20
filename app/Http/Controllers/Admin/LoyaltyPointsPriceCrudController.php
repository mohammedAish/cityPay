<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoyaltyPointsPriceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LoyaltyPointsPriceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LoyaltyPointsPriceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\LoyaltyPointsPrice::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/loyaltypointsprice');
        CRUD::setEntityNameStrings(trans('lang.loyaltypointsprice'),trans('lang.loyalty_points_prices'));
        $this->crud->orderBy('id','asc');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        /*
         * `from`, `to`, `badge_id`, `price`, `description`
         *
         */
        $this->crud->addColumns([
            [
                'name'  => 'from',
                'type'  => 'number',
                'label' => trans('lang.from'),
            ],
            [
                'name'  => 'to',
                'type'  => 'number',
                'label' => trans('lang.to'),
            ],
            [
                'entity'    => 'badge',
                'model'     => 'App\\Models\\Badge',
                'attribute' => 'name',
                'label'     => trans('lang.badge_name'),
            ],
            [
                'name'       => 'price',
                'type'       => 'text',

                'label' => trans('lang.price_loyalty'),
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
        CRUD::setValidation(LoyaltyPointsPriceRequest::class);
        $this->crud->addFields([
            [
                'name'  => 'from',
                'type'  => 'number',
                'label' => trans('lang.from'),
            ],
            [
                'name'  => 'to',
                'type'  => 'number',
                'label' => trans('lang.to'),
            ],
            [
                'type'      => 'select2',
                'name'      => 'badge_id',
                'entity'    => 'badge',
                'model'     => 'App\\Models\\Badge',
                'attribute' => 'name',
                'label'     => trans('lang.Badges'),
            ],
            [
                'name'       => 'price',
                'type'       => 'number',
                'attributes' => ["step" => "any"],
                'label'      => trans('lang.price_loyalty'),
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
