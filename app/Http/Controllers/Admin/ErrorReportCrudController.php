<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ErrorReportRequest;
use App\Notifications\ErrorReportNotification;
use App\Notifications\IdentityDocumentationStatusUpdate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ErrorReportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ErrorReportCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ErrorReport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/errorreport');
        CRUD::setEntityNameStrings(cp('ErrorReports'), cp('ErrorReports'));

        CRUD::denyAccess(['create', 'delete', 'show']);
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
            ], [
                'name'  => 'status',
                'type'  => 'custom_status_error',
                'label' => trans('lang.status'),
            ],[
                'name'  => 'error_link',
                'type'  => 'text',
                'label' => cp('error_link')
            ], [
                'name'  => 'error_action',
                'type'  => 'text',
                'label' => cp('error_action'),
            ], [
                'name'  => 'error_file',
                'type'  => 'view_file',
                'label' => trans('lang.error_file'),
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
        CRUD::setValidation(ErrorReportRequest::class);

        CRUD::field('created_at');
        CRUD::field('customer_id');
        CRUD::field('error_action');
        CRUD::field('error_file');
        CRUD::field('error_link');
        CRUD::field('id');
        CRUD::field('status');
        CRUD::field('updated_at');

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
            'label'           => cp('custom_status_error'),
            'type'            => 'select_from_array',
            'options'         => [
                0 => 'جديد',
                1 => 'قيد المراجعة',
                2 => 'تم الحل',
            ],
            'allows_null'     => false,
            'allows_multiple' => false,
            'default'         => $order->status,
        ];

        if ($order->status == 2) {
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
                $subject = 'error_report_subject_under_review';
                $descritpion = 'error_report_description_under_review';
                $ticket_id = 'error_report_description_under_review';
            } else {
                $subject = 'error_report_subject_fixed';
                $descritpion = 'error_report_description_fixed';
                $ticket_id = 'error_report_description_fixed';
            }

            $order->customer->notify(new ErrorReportNotification($subject, $descritpion,$ticket_id));
         
        }

        return redirect()->to(backpack_url('errorreport'));
    }
}
