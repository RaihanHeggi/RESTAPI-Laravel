<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function index(Request $request){
        $path = $request->segments();
        $function = $path[1];

        switch($function){
            case 'register':   
                $this->register($request);
            default : 
                $data = [];
                $this->login($data);
        }
    }

    protected function register($data){
        $returnValue = [];
        $validator = Validator::make($data->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return $this->SendError('Validation Error', 'Error to Validate Input', 500);
        };

        $input = $data->all();
        $input['password'] = bcrypt($input['password']);
        User::create($input);

        $returnValue = [
            'token' => $user->createToken('userToken')->plainTextToken,
            'name' => $user->name,
            'email' => $user->email
        ];

        return $this->sendSuccesss($returnValue, 'Success Register User', 200);
    }

    protected function login($data){
        echo 'Login Function';
    }
}    
