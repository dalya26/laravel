<?php

namespace App\Http\Controllers;

use App\Models\m_alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http\Models\Alumno;

class alumnoController extends Controller
{
    public function index(){
        return view('alumno');
    }
    public function lista(){
       // $alumno = m_alumno::all();
        $alumnos = m_alumno::join('materia','alumno.id_materia','=','materia.id')
       -> select('alumno.*', 'materia.nombre as nombre_materia')
        ->get(); 
        return $alumnos;
    }
    public function alumno(Request $request){
        $alumno = m_alumno::find($request->id);
        return $alumno;
    }
    public function guardar(Request $request){
        if($request->id == 0){
            $alumno = new m_alumno();
        }
        else {
            $alumno = m_alumno::find($request->id);
        }

        $alumno->nombre = $request->nombre;
        $alumno->apetpat = $request->apetpat;
        $alumno->apetmat = $request->apetmat;
        $alumno->matricula = $request->matricula;
        $alumno->edad = $request->edad;
        $alumno->sexo = $request->sexo;

        $alumno->id_materia = $request->id_materia;

        $alumno->save();

        return $alumno;
        
    }
    public function borrar(Request $request){

        $alumno = m_alumno::find($request->id);
        $alumno ->delete();
        return "OK";
    }

}
