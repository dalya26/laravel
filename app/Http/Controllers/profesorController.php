<?php

namespace App\Http\Controllers;

use App\Models\m_profesor;
use Illuminate\Http\Request;

class profesorController extends Controller
{
    public function index(){
        return view('profesor');
    }
    public function lista(){
        //$profesor = m_profesor::all();
        $profesor = m_profesor::join('materia','profesor.id_materia','=','materia.id')
        -> select('profesor.*', 'materia.nombre as nombre_materia')
        ->get(); 
        return $profesor;
    }
    public function profesor(Request $request){
        $profesor = m_profesor::find($request->id);
        return $profesor;
    }

    public function guardar(Request $request){
        if($request->id == 0){
            $profesor = new m_profesor();
        }
        else {
            $profesor = m_profesor::find($request->id);
        }

        $profesor->nombre = $request->nombre;
        $profesor->apetpat = $request->apetpat;
        $profesor->apetmat = $request->apetmat;
        $profesor->matricula = $request->matricula;
        $profesor->edad = $request->edad;
        $profesor->sexo = $request->sexo;
        $profesor->cedula = $request->cedula;
        $profesor->asignatura = $request->asignatura;
        $profesor->habilidades = $request->habilidades;

        $profesor->id_materia = $request->id_materia;

        $profesor->save();

        return $profesor;
    }
    public function borrar(Request $request){

        $profesor = m_profesor::find($request->id);
        $profesor ->delete();
        return "OK";
    }
    

}
