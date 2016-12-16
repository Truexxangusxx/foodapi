<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gusto;

class ApiController extends Controller
{
        public function GustosListar(Request $request){

            $error=true;
            $msg="";

            $gustos=Gusto::all();
            $error=false;

        return response()->json(['gustos'=>$gustos, 'error'=>$error, 'msg'=>$msg]);
    }
}
