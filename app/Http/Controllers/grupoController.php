<?php

namespace App\Http\Controllers;

use App\Models\m_grupo;
use Illuminate\Http\Request;

class grupoController extends Controller
{
    public function index()
    {
        return view('grupos');
    }

    public function lista(Request $request)
    {
        $grupo = m_grupo::all();
        return $grupo;
    }
    public function grupos(Request $request)
    {
        $grupo = m_grupo::find($request->id);
        return $grupo;
    }

    public function guardar(Request $request)
    {
        if ($request->id == 0) {
            $grupo = new m_grupo();
        } else {
            $grupo = m_grupo::find($request->id);
        }
        $grupo->grupo = $request->grupo;

        $grupo->save();
        return $grupo;
    }

    public function borrar(Request $request)
    {
        $grupo = m_grupo::find($request->id);
        $grupo->delete();
        return "OK";
    }

    public function combo(){
    
        $grupo = m_grupo::select('grupo as name', 'id as code')->get();
        return $grupo;
    }
    
}
