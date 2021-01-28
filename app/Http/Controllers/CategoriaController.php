<?php

namespace App\Http\Controllers;

use App\Vacante;
use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        $vacantes = Vacante::where('categoria_id', $categoria->id)->where('activa', 1)->paginate(10);

        return view('categorias.show', compact('vacantes', 'categoria'));
    }
}
