<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Validator;

class AuthController extends BaseController
{
    public function index(Request $request){
        $path = $request->segments();
        $function = $path[1];

        switch($function){
            case 'register':   
                return $this->register($request);
                break;
            case 'signin':
                return $this->login($request);
                break;
            default : 
                $data = [];
                return $this->sendError('Page Not Found', [], 404);
        }
    }

    protected function register($data){
        $returnValue = [];
        $validator = Validator::make($data->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return $this->sendError('Something Error', $validator->errors()->first(), 500);
        };

        $input = $data->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $returnValue = [
            'token' => $user->createToken('userToken')->plainTextToken,
            'name' => $user->name,
            'email' => $user->email
        ];

        return $this->sendResponse($returnValue, 'Success Register User', 200);
    }

    protected function login($data){
        $returnValue = [];
        
        if(Auth::attempt(['email' => $data->email, 'password' => $data->password])){
            $user = Auth::user();
            $returnValue = [
                'token' => $user->createToken('userToken')->plainTextToken,
                'name' => $user->name,
                'email' => $user->email
            ];

        }else{
            return $this->sendError('Failed to Login', [], 401);
        }
        
        return $this->sendResponse($returnValue, "Login Successfuly", 200);
    }
}    
