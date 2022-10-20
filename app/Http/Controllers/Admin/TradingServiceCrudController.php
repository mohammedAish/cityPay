<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TradingServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TradingServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TradingServiceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TradingService::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/tradingservice');
        CRUD::setEntityNameStrings(trans('lang.trading_service'),trans('lang.TradingServices'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.service_name'),
            ],
            [
                'model'       => 'App\\Models\\Service',
                'entity'      => 'commonService',
                'attribute'   => 'name',
                'label'       => trans('lang.service_name'),
                'searchLogic' => function ($query,$column,$searchTerm){
                    $query->orWhereHas('commonService',function ($q) use ($column,$searchTerm){
                        $q->where('name','like','%'.$searchTerm.'%');
                    });
                },
                'wrapper'     => [
                    // 'element' => 'a', // the element will default to "a" so you can skip it here
                    'href' => function ($crud,$column,$entry,$related_key){
                        return backpack_url('service/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name'  => 'description',
                'type'  => 'markdown',
                'label' => trans('lang.description_trading_service'),
            ],
            [
                'name'  => 'is_operational',
                'type'  => 'boolean',
                'label' => trans('lang.is_operational'),
            ],[
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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
        $this->crud->addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.service_name'),
            ],
            [
                'type'   => 'select2',
                'model'  => 'App\\Models\\Service',
                'entity' => 'commonService',
                'name'   => 'common_service_id',
                'label'  => trans('lang.service_name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'summernote',
                'label' => trans('lang.description_trading_service'),
            ],
            [
                'name'  => 'is_operational',
                'type'  => 'boolean',
                'label' => trans('lang.is_operational'),
            ],
            [
                'name'  => 'active',
                'type'  => 'boolean',
                'label' => trans('lang.active'),
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

    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }
}
