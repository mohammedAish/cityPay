<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceFeatureRequest;
use App\Models\ParentService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceFeatureCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServiceFeatureCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ServiceFeature::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/servicefeature');
        CRUD::setEntityNameStrings(trans('lang.service_features'),trans('lang.services_features'));
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
                .$this->parent_service_id.'/servicefeature'));
            $this->crud->addClause('where','parent_service_id','=',$this->parent_service_id);
            //$this->crud->setParentRoute(admin_uri('parentservice'));
            // $this->crud->setParentEntityNameStrings(trans('lang.ParentServices'),
            //  trans('lang.ParentServices'));
        }
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
                'name'  => 'description',
                'type'  => 'textarea',
                'label' => trans('lang.feature_description'),
            ],
            [
                'name'  => 'parentService',
                'type'  => 'relationship',
                'label' => trans('lang.parent_service'),
                'wrapper'     => [
                    // 'element' => 'a', // the element will default to "a" so you can skip it here
                    'href' => function ($crud,$column,$entry,$related_key){
                        return backpack_url('parentservice/'.$related_key.'/show');
                    },
                ],
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
        CRUD::setValidation(ServiceFeatureRequest::class);
        CRUD::addField(
            [
                'name'  => 'description',
                'type'  => 'summernote',
                'label' => trans('lang.feature_description'),
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
                    'entity'     => 'parentService',
                    'model'      => 'App\\Models\\ParentService',
                    'attribute'  => 'name',
                    'label'      => trans('lang.parent_service'),
                    'attributes' => [
                        'placeholder' => trans('lang.Choose_services'),
                    ],

                ]);
        }
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
