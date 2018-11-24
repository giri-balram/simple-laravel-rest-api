<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;

/**
 * Class FieldController.
 * @desc Field Api end point CRUD operation
 */
class FieldController extends Controller
{
	/**
    * List all the resources for Field
    *
    * @param null
    *
    * @return mix
    */
    public function index()
    {
        return Field::all();
    }

    /**
    * List particluar resource of Field
    *
    * @param Obj Field
    *
    * @return mix
    */
    public function show(Field $field)
    {
        return $field;
    }

    /**
    * Store data for a particluar resource of Field
    *
    * @param Obj Request 
    *
    * @return json
    */
    public function store(Request $request)
    {
        $field = Field::create($request->all());

        return response()->json($field, 201);
    }

    /**
    * Upadte data for a particluar resource of Field
    *
    * @param Obj Request 
    * @param Obj Field 
    *
    * @return json
    */
    public function update(Request $request, Field $field)
    {
        $field->update($request->all());

        return response()->json($field, 200);
    }

    /**
    * Delete a particluar resource of Field
    *
    * @param Obj Field 
    *
    * @return json
    */
    public function delete(Field $field)
    {
        $field->delete();

        return response()->json(null, 204);
    }
}
