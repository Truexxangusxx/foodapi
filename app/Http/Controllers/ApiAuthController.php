<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\User;
use Hash;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class ApiAuthController extends Controller
{
    public function UserAuth(Request $request){
        $credentials=$request->only('email','password');
        $token=null;
        $error=true;

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['msg'=>'credenciales invalidas', 'error'=>$error]);
            }
        }catch(JWTException $ex){
            return response()->json(['msg'=>'algo salio mal', 'error'=>$error],500);
        }
        $error=false;
        return response()->json(['token'=>$token, 'error'=>$error]);

    }

    public function signup(Request $request)
    {
            $error=true;
            $messages=[
                'required' => 'El campo :attribute es necesario.',
                'email' => 'El :attribute no es un correo valido.',
                'unique:users' => 'El :attribute ya esta registrado.',
            ];

            $validator =  Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            ],$messages);
            //confirmed necesita el campo password_confirmation

            if ($validator->fails()) {
                return response()->json(['messages'=>$validator->messages(), 'error'=>$error, 'email'=>$request->input('email')]);
            }else{
            User::create(['name'=>$request->input('name'),'email'=>$request->input('email'),'password'=>Hash::make($request->input('password'))]);
            $error=false;

            $credentials=$request->only('email','password');
            $token=null;
            try{
                if(!$token = JWTAuth::attempt($credentials)){
                    return response()->json(['msg'=>'credenciales invalidas']);
                }
            }catch(JWTException $ex){
                return response()->json(['msg'=>'algo salio mal'],500);
            }
                //return response()->json(compact('token'));
                return response()->json(['token'=>$token, 'error'=>$error]);
            }
    }

    
}
