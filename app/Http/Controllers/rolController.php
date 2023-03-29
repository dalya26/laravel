<?php

namespace App\Http\Controllers;

use App\Models\m_rol;
use Illuminate\Http\Request;

class rolController extends Controller
{
    public function lista(Request $request){
        $rol = m_rol::all();
        return $rol;
    }
    public function roles(Request $request){
        $rol = m_rol::find($request->id);
        return $rol;
    }

    public function guardar(Request $request){
        if($request->id == 0){
            $rol = new m_rol();
        }
        else{
            $rol = m_rol::find($request->id);
        }
        $rol->roll = $request->roll;

        $rol->save();
        return $rol;
    }

    public function borrar(Request $request){
        $rol = m_rol::find($request->id);
        $rol ->delete();
        return "OK";
    }

    public function combo(){
        $rol = m_rol::select('rol as name', 'id as code')->get();
        return $rol;
    }
}
