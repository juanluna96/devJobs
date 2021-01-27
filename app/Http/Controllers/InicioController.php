<?php

namespace App\Http\Controllers;

use App\Vacante;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function __invoke()
    {
        $vacantes = Vacante::latest()->where('activa', 1)->take(10)->get();
        return view('inicio.index', compact('vacantes'));
    }
}
