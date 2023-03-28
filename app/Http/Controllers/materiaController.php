<?php

namespace App\Http\Controllers;
use App\Models\m_materia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class materiaController extends Controller
{
    public function index(){
        return view('materia');
    }
    public function lista(){
        #Primer try
        try{
            $materia = m_materia::all();
            return $materia;
        }catch(Exception $e){
            Log::error('Metodo Lista clase MateriaController->' .$e->getMessage());
        }
        
    }
    public function materia(Request $request){
        #Segundo try
        try{
            $materia = m_materia::find($request->id);
            return $materia;
        }catch(Exception $e){
            Log::error('Metodo materia clase MateriaController->' .$e->getMessage());
        }
        
    }
    public function guardar(Request $request){
        #Tercer try
        try{
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
        }catch(Exception $e){
            Log::error('Metodo Guardar clase MateriaController->' .$e->getMessage());
        }
        
    }
    public function borrar(Request $request){
        #Cuarto try
        try{
            $materia = m_materia::find($request->id);
            $materia ->delete();
            return "OK";
        }catch(Exception $e){
            Log::error('Metodo Borrar clase MateriaController->' .$e->getMessage());

        }
    }
    public function combo(){
        #Quinto try
        try{
            $materia = m_materia::select('nombre as name', 'id as code')->get();
            return $materia;
        }catch(Exception $e){
            Log::error('Metodo Combo clase MateriaController->' .$e->getMessage());
        }
        
    }
}
