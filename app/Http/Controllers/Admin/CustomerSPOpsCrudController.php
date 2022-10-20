<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerSPOpsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerSPOpsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerSPOpsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CustomerSPOps::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customerspops');
        CRUD::setEntityNameStrings('customerspops', 'customer_s_p_ops');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    /**
     * `customer_id`, `customers_service_package_id`,
     * `description`, `link_url`, `file_path`, `current_status`,
     * `ip_address`, `device_type`, `device_info`, `admin_note`,
     *
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'type'       => 'select2',
                'name'       => 'customer_id',
                'entity'     => 'customer',
                'model'      => 'App\\Models\\Customer',
                'attribute'  => 'first_name',
                'label'      => trans('lang.customer'),
                'attributes' => [
                    'placeholder' => trans('lang.Choose_customer'),
                ],
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/'.$related_key.'/show');
                    },
                ],
            ],

            [
                'type'       => 'select2',
                'name'       => 'service_package_id',
                'entity'     => 'servicePackage',
                'model'      => 'App\\Models\\ServicesPackage',
                'attribute'  => 'name',
                'label'      => trans('lang.service_package'),
                'attributes' => [
                    'placeholder' => trans('lang.service_package'),
                ],
            ],
            [
                'name'  => 'description',
                'type'  => 'ckeditor',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'link_url',
                'type'  => 'url',
                'label' => trans('lang.link_url'),
            ],
            [
                'name'  => 'file_path',
                'type'  => 'upload',
                'label' => trans('lang.file_path'),
            ],
            [
                'name'  => 'current_status',
                'type'  => 'enum',
                'label' => trans('lang.current_status'),
            ],
            [
                'name'  => 'ip_address',
                'type'  => 'text',
                'label' => trans('lang.ip_address'),
            ],
            [
                'name'  => 'device_type',
                'type'  => 'enum',
                'label' => trans('lang.device_type'),
            ],
            [
                'name'  => 'device_info',
                'type'  => 'textarea',
                'label' => trans('lang.device_info'),
            ],
            [
                'name'  => 'admin_note',
                'type'  => 'textarea',
                'label' => trans('lang.admin_note'),
            ],

        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomerSPOpsRequest::class);

        CRUD::addFields([
            [
                'type'       => 'select2',
                'name'       => 'customer_id',
                'entity'     => 'customer',
                'model'      => 'App\\Models\\Customer',
                'attribute'  => 'first_name',
                'label'      => trans('lang.customer'),
                'attributes' => [
                    'placeholder' => trans('lang.Choose_services'),
                ],
            ],
            [
                'type'       => 'select2',
                'name'       => 'service_package_id',
                'entity'     => 'servicePackage',
                'model'      => 'App\\Models\\ServicesPackage',
                'attribute'  => 'name',
                'label'      => trans('lang.service_package'),
                'attributes' => [
                    'placeholder' => trans('lang.service_package'),
                ],
            ],
            [
                'name'  => 'description',
                'type'  => 'ckeditor',
                'label' => trans('lang.description'),
            ],
            [
                'name'  => 'link_url',
                'type'  => 'url',
                'label' => trans('lang.link_url'),
            ],
            [
                'name'  => 'file_path',
                'type'  => 'upload',
                'label' => trans('lang.file_path'),
            ],
            [
                'name'  => 'current_status',
                'type'  => 'enum',
                'label' => trans('lang.current_status'),
            ],
            [
                'name'  => 'ip_address',
                'type'  => 'text',
                'label' => trans('lang.ip_address'),
            ],
            [
                'name'  => 'device_type',
                'type'  => 'enum',
                'label' => trans('lang.device_type'),
            ],
            [
                'name'  => 'device_info',
                'type'  => 'textarea',
                'label' => trans('lang.device_info'),
            ],
            [
                'name'  => 'admin_note',
                'type'  => 'textarea',
                'label' => trans('lang.admin_note'),
            ],

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
    protected function setupUpdateOperation()
    {
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
