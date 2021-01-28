<?php

namespace App\Http\Controllers;

use App\Vacante;
use App\Ubicacion;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        $vacantes = Vacante::latest()->where('activa', 1)->take(10)->get();
        $ubicaciones = Ubicacion::all();
        return view('inicio.index', compact('vacantes', 'ubicaciones'));
    }
}
