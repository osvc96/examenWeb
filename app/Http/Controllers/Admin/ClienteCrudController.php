<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClienteRequest as StoreRequest;
use App\Http\Requests\ClienteRequest as UpdateRequest;
use Illuminate\Foundation\Auth\User;

class ClienteCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Cliente');
        $this->crud->setRoute('admin/clientes');
        $this->crud->setEntityNameStrings('cliente', 'clientes');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        //$this->crud->setFromDb();

        $this->crud->addColumns([
            [
                'name' => 'nombre',
                'label' => 'Nombre'
            ],

            [
                'name' => 'apellido',
                'label' => 'Apellido'
            ],

            [
                'name' => 'fecha_nacimiento',
                'label' => 'Fecha de Nacimiento'
            ],

            [
                'name' => 'direccion',
                'label' => 'Direccion'
            ],

            [
                'name' => 'estado_civil',
                'label' => 'Estado Civil'
            ],

            [
                'name' => 'sexo',
                'label' => 'Sexo'
            ],

            [
                'name' => 'descuento',
                'label' => 'Descuento',
                'suffix' => "%"
            ]
            ]);

        $this->crud->addFields([
            [ 
                'name' => 'nombre',
                'label' => "Nombre",
                'type' => 'text'
            ],

            [ 
                'name' => 'apellido',
                'label' => "Apellido",
                'type' => 'text'
            ],
            [ 
                'name' => 'fecha_nacimiento',
                'label' => "Fecha Nacimiento",
                'type' => 'date'
            ],
            [ 
                'name' => 'direccion',
                'label' => "Direccion",
                'type' => 'text'
            ],

            [ 
                'name' => 'estado_civil',
                'label' => "Estado Civil",
                'type' => 'text'
            ],
            [
                'name' => 'sexo',
                'label' => 'Sexo',
                'type' => 'radio',
                'options' => [ 
                        'M' => "Masculino",
                        'F' => "Femenino"
                    ],// optional
                'inline' => true, // show the radios all on the same line?
            ],

            [
                'name' => 'descuento',
                'label' => 'descuento',
                'type' => 'number',
                'attributes' => ["step" => "any"], 
                'suffix' => "%"
            ]
            ],'create/update/both');

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        if ($user->hasPermissionTo('edit Clientes'))
            $this->crud->allowAccess(['list', 'update', 'reorder', 'delete']);
        else{
            $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        }
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
