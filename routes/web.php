<?php

use Illuminate\Http\Request;
use App\Registration;

//Form requests are not supported by Lumen
$router->post('/registration', function (Request $request) {
    $this->validate($request, [
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
		
});	

$router->post('/login', 'LoginController@login');

$router->post('/insert', ['middleware'=>'auth', 'uses'=>'PhoneBookController@insert']);
$router->post('/select', ['middleware'=>'auth', 'uses'=>'PhoneBookController@select']);
$router->post('/delete', ['middleware'=>'auth', 'uses'=>'PhoneBookController@destroy']);
$router->post('/show', ['middleware'=>'auth', 'uses'=>'PhoneBookController@showByName']);


