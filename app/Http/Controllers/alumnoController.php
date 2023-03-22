<?php

namespace App\Http\Controllers;

use App\Models\m_alumno;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http\Models\Alumno;

class alumnoController extends Controller
{
    public function index(){
        return view('alumno');
    }
    public function lista(){
       //Primer Try-Catch
       try{
        /**$alumnos = m_alumno::join('materia','alumno.id_materia','=','materia.id')
        -> select('alumno.*', 'materia.nombre as nombre_materia')
        ->get();*/
            $alumnos = m_alumno::join('materia', 'alumno.id_materia', '=', 'materia.id') &&
            $alumnos = m_alumno::join('grupos', 'alumno.id_grupo', '=', 'grupos.id')
            ->select('alumno.*', 'materia.nombre as nombre_materia, grupos.grupo as nombre_grupo')
            ->get();
         return $alumnos;
       }catch(Exception $e){
           Log::error('Metodo Lista clase AlumnoController->' .$e->getMessage());
       }
       
    }
    public function alumno(Request $request){
        //Segundo Try-Catch
        try{
            $alumno = m_alumno::find($request->id);
            return $alumno;
        }catch(Exception $e){
            Log::error('Metodo Alumno clase AlumnoController->' .$e->getMessage());
        
        }

    }

    public function guardar(Request $request){
    
        if($request->id == 0){
            $alumno = new m_alumno();
        }
        else {
            $alumno = m_alumno::find($request->id);
        }

       //Tercer Try-Catch
        try{
            $alumno->nombre = $request->nombre;
            $alumno->apetpat = $request->apetpat;
            $alumno->apetmat = $request->apetmat;
            $alumno->matricula = $request->matricula;
            $alumno->edad = $request->edad;
            $alumno->sexo = $request->sexo;
            $alumno->id_materia = $request->id_materia;
            $alumno->id_grupo = $request->id_grupo;

            $alumno->save();
            return $alumno;
        }catch(Exception $e){
            Log::error('Metodo Guardar clase AlumnoController->' .$e->getMessage());
        }
        
    }
    public function borrar(Request $request){
        //Cuarto Try-Catch
        try{
            $alumno = m_alumno::find($request->id);
            $alumno ->delete();
            return "OK";
        }catch(Exception $e){
            Log::error('Metodo Borrar clase AlumnoController->' .$e->getMessage());
        
        }
    }

}
