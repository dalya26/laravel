<?php

namespace App\Http\Controllers;
use App\Models\m_materia;


use Illuminate\Http\Request;

class materiaController extends Controller
{
    public function index(){
        return view('materia');
    }
    public function lista(){
        $materia = m_materia::all();
        return $materia;
    }
    public function materia(Request $request){
        $materia = m_materia::find($request->id);
        return $materia;
    }
    public function guardar(Request $request){
        if($request->id == 0){
            $materia
             = new m_materia();
        }
        else {
            $materia = m_materia::find($request->id);
        }
        $materia->nombre = $request->nombre;
        $materia->profesor = $request->profesor;
        $materia->horario = $request->horario;
        $materia->save();

        return $materia;
    }
    public function borrar(Request $request){

        $materia = m_materia::find($request->id);
        $materia ->delete();
        return "OK";
    }
    public function combo(){
        $materia = m_materia::select('nombre as name', 'id as code')->get();
        return $materia;
    }
}
