<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\m_rol;

class rolesController extends Controller
{
    public function lista(Request $request){
        $rol = m_rol::all();
        return $rol;
    }
    public function roles(Request $request){
        $rol = m_rol::find($request->id);
        return $rol;
    }
    public function combo(){
        $rol = m_rol::select('name as name', 'id as code')->get();

            return $rol;
            
        }
}
