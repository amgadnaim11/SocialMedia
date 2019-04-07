<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class LoginController extends BaseController
{
        public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'email' => 'required|email',
            'password' => 'required',
        ]);

       
        $user = User::where('email', $request->input('email'))->first();
             if(Hash::check($request->input('password'), $user->password)){


                 return $this->sendResponse($user, 'User login successfully.');

} else {

            return $this->sendError('Wrong Email or Password.', $validator->errors());       
        }
      


    }}
