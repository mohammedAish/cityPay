<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Comment::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/comment');
        CRUD::setEntityNameStrings(trans('lang.comment'),trans('lang.comments'));
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
                'name'  => 'customer',
                'type'  => 'relationship',
                'label' => trans('lang.customer'),
            ],
            [
                'name'  => 'content',
                'type'  => 'text',
                'label' => trans('lang.content'),
            ],
            [
                'name'  => 'commentable_type',
                'type'  => 'boolean',
                'label' => trans('lang.commentable_type'),
            ],
            [
                'name'  => 'likes',
                'type'  => 'boolean',
                'label' => trans('lang.likes'),
            ],
            [
                'name'  => 'dislikes',
                'type'  => 'boolean',
                'label' => trans('lang.dislikes'),
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
    protected function setupCreateOperation(){
        CRUD::setValidation(CommentRequest::class);

        CRUD::addFields([

            [
                'name'  => 'customer',
                'type'  => 'relationship',
                'label' => trans('lang.customer'),
            ],
            [
                'name'  => 'content',
                'type'  => 'text',
                'label' => trans('lang.content'),
            ],
            [
                'name'  => 'commentable_type',
                'type'  => 'boolean',
                'label' => trans('lang.commentable_type'),
            ],
            [
                'name'  => 'likes',
                'type'  => 'boolean',
                'label' => trans('lang.likes'),
            ],
            [
                'name'  => 'dislikes',
                'type'  => 'boolean',
                'label' => trans('lang.dislikes'),
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
