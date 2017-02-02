<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gusto;
use Storage;
use App\Proveedor;

class ApiController extends Controller
{
    public function GustosListar(Request $request){

            $error=true;
            $msg="";

            $gustos=Gusto::all();
            $error=false;

        return response()->json(['gustos'=>$gustos, 'error'=>$error, 'msg'=>$msg]);
    }

    public function GustosAgregar(Request $request){

            $error=true;
            $msg="";
            $user_id=$request->input('user_id');
            $gusto_id=$request->input('gusto_id');
            
            $user = User::find($user_id);
            
            $encontrado=false;
            foreach($user->gustos()->get() as $item){
                if($item->id==$gusto_id){
                    $encontrado=true;
                }
            }
            if (!$encontrado){
                $gusto = Gusto::find($gusto_id);
                $user->gustos()->save($gusto);
                $error=false;
                $msg="gusto ingresado correctamente";    
            }
            else{
                $error=false;
                $msg="gusto ya registrado";    
            }
            
            

            return response()->json(['error'=>$error, 'msg'=>$msg]);
    }
    
    public function imagen(Request $request){
        $file = Storage::get('images/logo.PNG');

        return response($file, 200)->header('Content-Type', 'image/PNG');
    }
    
    public function icon(Request $request){
        $file = Storage::get('images/icon.png');

        return response($file, 200)->header('Content-Type', 'image/png');
    }
    
    public function marca(Request $request){
        $file = Storage::get('images/marca.png');

        return response($file, 200)->header('Content-Type', 'image/png');
    }
    
    public function buscarimagen(Request $request){
        $imagen=$request->input('imagen');
        $file = Storage::get('images/'.$imagen);

        return response($file, 200)->header('Content-Type', 'image/jpg');
    }

    public function ProveedorGuardar(Request $request){

            $error=true;
            $msg="ocurrio un error inesperado";
            $user_id=$request->input('user_id');
            $nombre=$request->input('nombre');
            $direccion=$request->input('direccion');
            $horario=$request->input('horario');
            $lat=$request->input('lat');
            $lon=$request->input('lon');
            
            
            if (Proveedor::where('id',$user_id)->count()==0){
                $proveedor = new Proveedor;
            }
            else{
                $proveedor = Proveedor::where('id',$user_id)->first();
            }
            
            $proveedor->user_id=$user_id;
            $proveedor->nombre=$nombre;
            $proveedor->direccion=$direccion;
            $proveedor->horario=$horario;
            
            if ($lat!=null){
                $proveedor->lat=$lat;
            }
            if ($lon!=null){
                $proveedor->lon=$lon;
            }
            
            
            $proveedor->save();
            $error=false;
            $msg="se registro correctamente";
            

            return response()->json(['error'=>$error, 'msg'=>$msg]);
    }


    public function ProveedorListar(Request $request){
            $error=true;
            $msg="ocurrio un error inesperado";
            
            $lat=$request->input('lat');
            $lon=$request->input('lon');
            
            $lista=Proveedor::where('lat','<',($lat+2))->where('lat','>',($lat-2))->where('lon','<',($lon+2))->where('lon','>',($lon-2))->get();
            $error=false;
            $msg="datos obtenidos sin problema";
            

            return response()->json(['lista'=>$lista,'error'=>$error, 'msg'=>$msg]);
    }
    
    public function SubirImagen(Request $request){
        
        $file = request()->file('archivo');
        $file->storeAs('images', $file->getClientOriginalName());
        return $file->getClientOriginalName();
         
    }


}
