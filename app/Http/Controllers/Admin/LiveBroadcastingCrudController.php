<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LiveBroadcastingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LiveBroadcastingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LiveBroadcastingCrudController extends CrudController
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
        CRUD::setModel(\App\Models\LiveBroadcasting::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/livebroadcasting');
        CRUD::setEntityNameStrings(trans('lang.livebroadcasting'),trans('lang.live_broadcastings'));
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
                'name'  => 'subject',
                'type'  => 'text',
                'label' => trans('lang.live_subject'),
            ],[
                'name'  => 'description',
                'type'  => 'text',
                'label' => trans('lang.description'),
            ],[
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ],[
                'name'  => 'start_at',
                'type'  => 'datetime',
                'label' => trans('lang.start_time'),
            ],[
                'name'  => 'end_at',
                'type'  => 'datetime',
                'label' => trans('lang.end_time'),
            ],[
                'name'  => 'sharing_link',
                'type'  => 'link',
                'label' => trans('lang.sharing_link'),
            ],[
                'name'  => 'external_link',
                'type'  => 'link',
                'label' => trans('lang.external_link'),
            ],[
                'name'  => 'author',
                'type'  => 'text',
                'label' => trans('lang.author_name'),
            ],[
                'name'  => 'active_now',
                'type'  => 'boolean',
                'label' => trans('lang.active_now'),
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
                'name'  => 'subject',
                'type'  => 'text',
                'label' => trans('lang.live_subject'),
            ],[
                'name'  => 'description',
                'type'  => 'text',
                'label' => trans('lang.description'),
            ],[
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.image'),
            ],[
                'name'  => 'start_at',
                'type'  => 'datetime',
                'label' => trans('lang.start_time'),
            ],[
                'name'  => 'end_at',
                'type'  => 'datetime',
                'label' => trans('lang.end_time'),
            ],[
                'name'  => 'sharing_link',
                'type'  => 'url',
                'label' => trans('lang.sharing_link'),
            ],[
                'name'  => 'external_link',
                'type'  => 'url',
                'label' => trans('lang.external_link'),
            ],[
                'name'  => 'author',
                'type'  => 'text',
                'label' => trans('lang.author_name'),
            ],[
                'name'  => 'active_now',
                'type'  => 'boolean',
                'label' => trans('lang.active_now'),
            ],[
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
}
