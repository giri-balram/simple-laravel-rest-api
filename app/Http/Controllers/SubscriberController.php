<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use EmailValidator;

/**
 * Class SubscriberController.
 * @desc Subscriber Api end point CRUD operation
 */
class SubscriberController extends Controller
{
	/**
    * List all the resources for Subscriber
    *
    * @param null
    *
    * @return mix
    */
    public function index()
    {
        return Subscriber::all();
    }

    /**
    * List particluar resource of Subscriber
    *
    * @param Obj Subscriber
    *
    * @return mix
    */
    public function show(Subscriber $subscriber)
    {
        return $subscriber;
    }

    /**
    * Store data for a particluar resource of Subscriber
    *
    * @param Obj Request 
    *
    * @return json
    */
    public function store(Request $request)
    {
    	//Check for valid Email address
    	if ($request->input('email_address')) {
    		if( !EmailValidator::verify($request->input('email_address'))->isValid()[0]){
    			return response()->json(['email' => 'Email address is not valid.'], 422);
    		}
    	} else {
    		return response()->json(['email' => 'The email field is required!'], 422);
    	}
    	

        $subscriber = Subscriber::create($request->all());

        return response()->json($subscriber, 201);
    }

    /**
    * Upadte data for a particluar resource of Subscriber
    *
    * @param Obj Request 
    * @param Obj Subscriber 
    *
    * @return json
    */
    public function update(Request $request, Subscriber $subscriber)
    {
    	//Check for valid Email address
    	if ($request->input('email_address')) {
    		if( !EmailValidator::verify($request->input('email_address'))->isValid()[0]){
    			return response()->json(['email' => 'Email address is not valid.'], 422);
    		}
    	} else {
    		return response()->json(['email' => 'The email field is required!'], 422);
    	}

        $subscriber->update($request->all());

        return response()->json($subscriber, 200);
    }

    /**
    * Delete a particluar resource of Subscriber
    *
    * @param Obj Subscriber 
    *
    * @return json
    */
    public function delete(Subscriber $subscriber)
    {
        $subscriber->delete();

        return response()->json(null, 204);
    }
}
