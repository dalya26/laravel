<?php

namespace App\Http\Controllers;

use App\Models\m_profesor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Exception;

class profesorController extends Controller
{
    public function index(){
        return view('profesor');
    }
    public function lista(){
        
        try{
            //$profesor = m_profesor::all();

    //$profesor = m_profesor::all();
    //Primer Try-Catch
        try{

            $profesor = m_profesor::join('materia','profesor.id_materia','=','materia.id')
            -> select('profesor.*', 'materia.nombre as nombre_materia')
            ->get(); 
            return $profesor;
        }catch(Exception $e){
            Log::error('Metodo Lista clase ProfesorController->' .$e->getMessage());
        }
        
    }
    public function profesor(Request $request){
       
            Log::error('Metodo Borrar clase ProfesorController->' .$e->getMessage());
        }
    }
    public function profesor(Request $request){
    //Segundo Try-Catch

        try{
            $profesor = m_profesor::find($request->id);
            return $profesor;
        }catch(Exception $e){

            Log::error('Metodo Profesor clase ProfesorController->' .$e->getMessage());
        }
        
            Log::error('Metodo Borrar clase ProfesorController->' .$e->getMessage());
        }

    }

    public function guardar(Request $request){
        #Primer try
        try{
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
        }catch(Exception $e){
            Log::error('Metodo Guardar clase ProfesorController->' .$e->getMessage());
        }
    }
    public function borrar(Request $request){

        try{
            $profesor->nombre = $request->nombre;
            $profesor->apetpat = $request->apetpat;
            $profesor->apetmat = $request->apetmat;
            $profesor->matricula = $request->matricula;
            $profesor->edad = $request->edad;
            $profesor->sexo = $request->sexo;
            $profesor->cedula = $request->cedula;
    
            $profesor->id_materia = $request->id_materia;
    
            $profesor->save();
            return $profesor;
        }catch(Exception $e){
            Log::error('Metodo Borrar clase ProfesorController->' .$e->getMessage());
        }
    }
    public function borrar(Request $request){

        try{
            $profesor = m_profesor::find($request->id);
            $profesor ->delete();
            return "OK";
        }catch(Exception $e){

            Log::error('Metodo Borarr clase ProfesorController->' .$e->getMessage());

        }
    }
    
}
