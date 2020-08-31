<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
    function login(Request $request){
		$username = $request->username;
		$password = $request->password;
		
		$userCount = Registration::where(['username'=>$username, 'password'=>$password])->count();

		if($userCount == 1){
			$key = env('TOKEN_KEY');
			$payload = array(
				"iss" => "http://demo.org",
				"user" => $username,
				"iat" => time(),
				"exp" => time()+3600
			);
			$jwt = JWT::encode($payload, $key);
			return response()->json(["Access-Token"=>$jwt, "Status"=>"Login successful"]);
		}
		else{
			return response('Wrong credentials');
		}
	}
	
}
