<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\PhoneBook;


class PhoneBookController extends Controller
{
    function insert(Request $request){
		
		$token = $request->access_token;
		$key = env('TOKEN_KEY');
		$decoded = JWT::decode($token, $key, array('HS256'));
		$decoded_array = (array)$decoded;
		$user = $decoded_array['user'];
		
		$phonebook = new PhoneBook; 
		$phonebook->username  		 = $user;
		$phonebook->phone_number_one = $request->phone_number_one;
		$phonebook->phone_number_two = $request->phone_number_two;
		$phonebook->name             = $request->name;
		$phonebook->email  			 = $request->email;
		$phonebook->save();
		
		return response('Data saved successfully');	
	}
	
	
	function select(Request $request){
		$result = PhoneBook::all();
		return response()->json($result);	
	}
	
	
	function destroy(Request $request){
		$name = $request->name;
		$phonebook = PhoneBook::where('name', $name)->delete();
		return response('Data deleted successfully');	
	}
	
	
	function showByName(Request $request){
		$name = $request->name;
		$phonebook = PhoneBook::where('name', $name)->get();
		return response($phonebook);
	}
	
}
