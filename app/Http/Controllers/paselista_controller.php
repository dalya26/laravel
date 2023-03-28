<?php

namespace App\Http\Controllers;
use App\Models\m_alumno;
use App\Models\m_pase_lista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;


class paselista_controller extends Controller
{       
    public  function paselista (Request $request)
    {

    //Primer Try-Catch
    try  {
        $datos = m_alumno::join('materia', 'alumno.id_materia','=','materia.id')
        ->where('id_materia','=', $request->id_materia)
        ->select('alumno.*', 'materia.nombre as nombre_materia')
        ->get();
        return $datos;
    }catch(Exception $e){
        Log::error('Metodo paselista clase paslista_controller->' .$e->getMessage());
    }
    }

    //Segundo Try-Catch
    public function lista(Request $request){

    try{
        $pase_lista = m_pase_lista::find($request->id);
        return $pase_lista;
    }catch(Exception $e){
        Log::error('Metodo paselista clase paslista_controller->' .$e->getMessage());
    }    
    }

    //Tercer Try-Catch
    public function guardar (Request $request){
        try{
            $verficarAsistencia = m_pase_lista::where('id_alumno',$request->id_alumno)->where('fecha', now())->first(); 
            if ($verficarAsistencia) {
                return response()->json(['mensage'=>'Ya se encuentra registrada la asistencia']);
            }
            $pase_lista = new m_pase_lista();
    
            $pase_lista->fecha = now();
            $pase_lista->id_alumno = $request->id_alumno;
            $pase_lista->asistio = $request->asistio;
    
            $pase_lista->save();
    
            return $pase_lista;
        }catch(Exception $e){
            Log::error('Metodo eliminar paselista clase paslista_controller->' .$e->getMessage());
        }
    }
}
