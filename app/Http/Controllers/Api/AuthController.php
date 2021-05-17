<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use JwtAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$credentials = $request->only('email','password');
    	
    	if(Auth::guard('api')->attempt($credentials)){
    		$user = Auth::guard('api')->user();
    		$jwt = JwtAuth::generateToken($user);
    		$sucess = true;
 		 
    		return compact('sucess','user','jwt');

    	} else {
    		$sucess = false;
    		$message = 'Invalid credentials';
    		return compact('sucess','message');
    	}
    	
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        $sucess = true;
        return compact('sucess');
    }
}
