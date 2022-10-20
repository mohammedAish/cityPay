<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceRequest;
use App\Models\ParentService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServiceCrudController extends CrudController
{
    public $parentEntity = null;
    public $parent_service_id = null;

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
        //parent setup
        $parentEntities = ['parentservice'];

        // Get the parent Entity slug
        $this->parentEntity = request()->segment(2);
        if (!in_array($this->parentEntity,$parentEntities)) {
            // abort(404);
        }
        CRUD::setModel(\App\Models\Service::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/service');
        // Parent => Child
        if ($this->parentEntity == 'parentservice') {
            // Get the parent service
            $this->parent_service_id = request()->segment(3);

            // Get the Parent name
            $parentService = ParentService::findOrFail($this->parent_service_id);
            $this->crud->with(['parentService']);
            //  $this->crud->enable();
            $this->crud->allowAccess(['parent']);

            //set clouses
            // $this->crud->setParentKeyField('id');

            $this->crud->setRoute(admin_uri('parentservice/'
                .$this->parent_service_id.'/service'));
            $this->crud->addClause('where','parent_service_id','=',$this->parent_service_id);
            //$this->crud->setParentRoute(admin_uri('parentservice'));
            // $this->crud->setParentEntityNameStrings(trans('lang.ParentServices'),
            //  trans('lang.ParentServices'));
        }

        CRUD::setEntityNameStrings(trans('lang.service'),trans('lang.services'));
        CRUD::orderBy('id','asc');
        CRUD::denyAccess(['create','delete']);
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
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],[
                'name'  => 'instructions',
                'type'  => 'markdown',
                'label' => trans('lang.customer_instructions'),
                //summernote
            ],
            [
                'name'  => 'parentService',
                'type'  => 'relationship',
                'label' => trans('lang.parentService'),
                'wrapper'     => [
                    // 'element' => 'a', // the element will default to "a" so you can skip it here
                    'href' => function ($crud,$column,$entry,$related_key){
                        return backpack_url('parentservice/'.$related_key.'/show');
                    },
                ],

            ],
            [
                'name'        => 'price_type',
                'label'       => trans('lang.price_type'),
                'type'        => 'select_from_array',
                'options'     => [
                    'paid' => 'مدفوعة',
                    'free' => 'مجانية',
                ],
                'allows_null' => false,
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],

            //deprecated
            /*[
                'name'  => 'packageServices',
                'type'  => 'relationship',
                'label' => trans('lang.packageServices'),
            ],*/

        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(){
        CRUD::setValidation(ServiceRequest::class);

        CRUD::addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.name'),
            ],
            [
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'instructions',
                'type'  => 'summernote',
                'label' => trans('lang.customer_instructions'),
                //
            ],
        ]);
        if (!empty($this->parent_service_id)) {
            $this->crud->addField([
                'name'  => 'parent_service_id',
                'type'  => 'hidden',
                'value' => $this->parent_service_id,
            ],'create');
        } else {
            $this->crud->addField(
                [
                    'type'       => 'select2',
                    'name'       => 'parent_service_id',
                    'model'      => 'App\\Models\\ParentService',
                    'entity'     => 'parentService',
                    'attribute'  => 'name',
                    'label'      => trans('lang.packageServices'),
                    'attributes' => ['disabled' => 'disabled'],
                ]);
        }

        $this->crud->addFields([

            [
                'name'        => 'price_type',
                'label'       => trans('lang.price_type'),
                'type'        => 'select_from_array',
                'options'     => [
                    'paid' => 'مدفوعة',
                    'free' => 'مجانية',
                ],
                'allows_null' => false,
            ],
            [
                'name'  => 'img_path',
                'type'  => 'image',
                'label' => trans('lang.img_path'),
            ],
            [
                'name'  => 'view_link',
                'type'  => 'text',
                'label' => trans('lang.view_link'),
            ],
//deprecated
            /* [
                 'name'  => 'packageServices',
                 'type'  => 'relationship',
                 'label' => trans('lang.packageServices'),
             ],*/

        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
