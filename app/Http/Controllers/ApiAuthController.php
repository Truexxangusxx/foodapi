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

    public function UserAuthToken(Request $request){
        $error=true;
        $user=null;

        try {
            $user = JWTAuth::parseToken()->authenticate();
            $token = str_replace("Bearer ", "", $request->header('Authorization'));
            $error =false;
        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            //return response()->json(['token_expired'], $e->getStatusCode());
            return response()->json(['msg' => 'El token ha expirado', 'error' => $error]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            //return response()->json(['token_invalid'], $e->getStatusCode());
            return response()->json(['msg' => 'El token es invalido', 'error' => $error]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            //return response()->json(['token_absent'], $e->getStatusCode());
            return response()->json(['msg' => 'No se ha enviado el token', 'error' => $error]);
        }

        return response()->json(['user' => $user, 'error' => $error]);


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


    public function ActualizarTipoUsuario(Request $request){
        $error=true;
        $user=null;
        $user_id=$request->input('user_id');
        $user_tipo=$request->input('tipo');
        $msg="";

        $user= User::find($user_id);
        $user->tipo=$user_tipo;
        if($user->save()){
            $error=false;
        }
        else{
            $msg="Ocurrio un error inesperado";
        }

        return response()->json(['user' => $user, 'error' => $error, 'msg' => $msg]);

    }

    
}
