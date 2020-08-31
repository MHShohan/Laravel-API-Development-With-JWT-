<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    function register(Request $request){
		
		$validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'city' 		=> 'required|max:255',
            'username'  => 'required|unique:registration|max:255',
            'password'  => 'required|max:255',
            'gender'    => 'required|max:255',
        ]);
		
		$registration = new Registration; 
		$registration->firstname = $request->firstname;
		$registration->lastname  = $request->lastname;
		$registration->city      = $request->city;
		$registration->username  = $request->username;
		$registration->password  = $request->password;
		$registration->gender    = $request->gender;
		$registration->save();
		
		return response('Registration successfull');
	}
}
