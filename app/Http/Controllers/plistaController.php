<?php

namespace App\Http\Controllers;

use App\Models\m_alumno;
use App\Models\m_plista;
use Illuminate\Http\Request;

class plistaController extends Controller
{
    public function paselista(Request $request)
    {
        $datos = m_alumno::join('materia', 'alumno.id_materia', '=', 'materia.id')
        ->where('id_materia', '=', $request->id_materia)
            ->select('alumno.*', 'materia.nombre as nombre_materia')
            ->get();

        return $datos;
    }

    public function guardar(Request $request)
    {
        $plista = new m_plista();

        $plista->fecha = now();
        $plista->id_alumno = $request->id_alumno;
        $plista->asistio = $request->asistio;

        $plista->save();

        return $plista;
    }
}
