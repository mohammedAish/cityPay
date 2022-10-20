<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IdentityDocumentationRequest;
use App\Notifications\IdentityDocumentationStatusUpdate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class IdentityDocumentationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class IdentityDocumentationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\IdentityDocumentation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/identitydocumentation');
        CRUD::setEntityNameStrings(cp('identitydocumentation'), cp('identitydocumentation'));

        CRUD::denyAccess(['create', 'delete']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'model'       => 'App\\Models\\Customer',
                'entity'      => 'customer',
                'attribute'   => 'name',
                'label'       => trans('lang.customer_name'),
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('customer', function ($q) use ($column, $searchTerm) {
                        $q->where('first_name', 'like', '%' . $searchTerm . '%')
                            ->orWhereDate('last_name', 'like', '%' . $searchTerm . '%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/' . $related_key . '/show');
                    },
                ],
            ],
            [
                'name'  => 'status',
                'type'  => 'custom_status',
                'label' => trans('lang.status'),
            ], [
                'name'  => 'first_name_en',
                'type'  => 'text',
                'label' => cp('name') . ' ' . cp('in_english_letters'),
            ], [
                'name'  => 'last_name_en',
                'type'  => 'text',
                'label' => cp('family_name') . ' ' . cp('in_english_letters'),
            ], [
                'name'  => 'birthdate',
                'type'  => 'date',
                'label' => trans('lang.birth_date'),
            ], [
                'name'  => 'mobile',
                'type'  => 'text',
                'label' => trans('lang.phone_number'),
            ], [
                'name'  => 'email',
                'type'  => 'text',
                'label' => trans('lang.email'),
            ], [
                'name'  => 'country_id',
                'type'  => 'text',
                'label' => trans('lang.country'),
            ], [
                'name'  => 'document_type',
                'type'  => 'text',
                'label' => trans('lang.document_type'),
            ], [
                'name'  => 'document_file',
                'type'  => 'view_file',
                'label' => trans('lang.document_file'),
            ], [
                'name'  => 'manager_address',
                'type'  => 'view_file',
                'label' => trans('lang.documents_confirming_manager_address'),
            ], [
                'name'  => 'created_at',
                'type'  => 'date',
                'label' => trans('lang.ag_date'),
            ],
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::addColumns([
            [
                'model'       => 'App\\Models\\Customer',
                'entity'      => 'customer',
                'attribute'   => 'name',
                'label'       => trans('lang.customer_name'),
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('customer', function ($q) use ($column, $searchTerm) {
                        $q->where('first_name', 'like', '%' . $searchTerm . '%')
                            ->orWhereDate('last_name', 'like', '%' . $searchTerm . '%');
                    });
                },
                'wrapper'     => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('customer/' . $related_key . '/show');
                    },
                ],
            ],
            [
                'name'  => 'status',
                'type'  => 'custom_status',
                'label' => trans('lang.status'),
            ], [
                'name'  => 'first_name_en',
                'type'  => 'text',
                'label' => cp('name') . ' ' . cp('in_english_letters'),
            ], [
                'name'  => 'last_name_en',
                'type'  => 'text',
                'label' => cp('family_name') . ' ' . cp('in_english_letters'),
            ], [
                'name'  => 'birthdate',
                'type'  => 'date',
                'label' => trans('lang.birth_date'),
            ], [
                'name'  => 'mobile',
                'type'  => 'text',
                'label' => trans('lang.phone_number'),
            ], [
                'name'  => 'email',
                'type'  => 'text',
                'label' => trans('lang.email'),
            ], [
                'name'  => 'country_id',
                'type'  => 'text',
                'label' => trans('lang.country'),
            ], [
                'name'  => 'document_type',
                'type'  => 'text',
                'label' => trans('lang.document_type'),
            ], [
                'name'  => 'document_file',
                'type'  => 'view_file',
                'label' => trans('lang.document_file'),
            ], [
                'name'  => 'manager_address',
                'type'  => 'view_file',
                'label' => trans('lang.documents_confirming_manager_address'),
            ], [
                'name'  => 'created_at',
                'type'  => 'date',
                'label' => trans('lang.ag_date'),
            ],
        ]);
    }
    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(IdentityDocumentationRequest::class);

        CRUD::setFromDb(); // fields

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
        $order = $this->crud->getCurrentEntry();
        $filed = [
            'name'            => 'status',
            'label'           => cp('change_status'),
            'type'            => 'select_from_array',
            'options'         => [
                0 => 'قيد المراجعة',
                1 => 'قبول',
                2 => 'رفض',
            ],
            'allows_null'     => false,
            'allows_multiple' => false,
            'default'         => $order->status,
        ];

        if ($order->status != 0) {
            $filed['attributes'] = [
                'readonly' => 'readonly',
                'disabled' => 'disabled',
            ];
        }
        $this->crud->addField($filed);
    }

    public function update()
    {
        $request = $this->crud->getRequest()->request;
        $status = $request->get('status');
        $order = $this->crud->getCurrentEntry();

        if ($status != $order->status) {
            $order->update(['status' => $status]);
            if ($order->status == 1) {
                $order->customer()->update(['is_verified' => 1]);
                $subject = 'identity_documentation_approved_subject';
                $descritpion = 'identity_documentation_approved_descritpion';
            } else {
                $subject = 'identity_documentation_rejected_subject';
                $descritpion = 'identity_documentation_rejected_descritpion';
            }

            $order->customer->notify(new IdentityDocumentationStatusUpdate($subject, $descritpion));
        }

        return redirect()->to(backpack_url('identitydocumentation'));
    }
}
