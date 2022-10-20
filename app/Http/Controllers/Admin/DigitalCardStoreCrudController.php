<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DigitalCardStoreRequest;
use App\Models\DigitalCardProviderPackage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DigitalCardStoreCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DigitalCardStoreCrudController extends CrudController
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
    public function setup(){

        CRUD::setModel(\App\Models\DigitalCardStore::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/digitalcardstore');
        CRUD::setEntityNameStrings(trans('lang.digitalcardstore'),trans('lang.digital_card_stores'));
        $this->crud->enableExportButtons();

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(){
        CRUD::addColumns([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.store_name'),
            ],[
                'name'  => 'shown',
                'type'  => 'boolean',
                'label' => trans('lang.store_shown'),
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
        CRUD::addFields([
            [
                'name'  => 'name',
                'type'  => 'text',
                'label' => trans('lang.store_name'),
            ],[
                'name'    => 'shown',
                'type'    => 'boolean',
                'default' => false,
                'label'   => trans('lang.store_shown'),
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

    public function destroy($id){
        if ($id == 1) {
            \Alert::error('لا يمكن حذف المتجر الافتراضي');

            return \Alert::getMessages();
        }
        $foundInPackages = DigitalCardProviderPackage::whereStoreId($id)->get();
        if ($foundInPackages->count() > 0) {
            \Alert::error('لا يمكن الحذف للمتجر لارتباطه ببيانات فئات الكروت');

            return \Alert::getMessages();
        }
        try {
            $deleted = $this->crud->delete($id);
        } catch (\Exception $ex) {
            \Alert::error('لا يمكن الحذف'.$ex->getMessage());

            return \Alert::getMessages();
        }

        return $deleted;
    }

    public function update(){
        $request = $this->crud->validateRequest();
        // update the row in the db
        $keyValue = $request->get($this->crud->model->getKeyName());
        if ($keyValue == 1) {
            \Alert::error('لا يمكن تعديل بيانات المتجر الافتراضي')->flash();
            // save the redirect choice for next time
            $this->crud->setSaveAction();
            return $this->crud->performSaveAction($keyValue);
        }

     /*   $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation(); // validation has already been run*/

        return $this->traitUpdate();
    }
    protected function setupShowOperation(){
        $this->crud->set('show.setFromDb',false);
        $this->setupListOperation();
    }
}
