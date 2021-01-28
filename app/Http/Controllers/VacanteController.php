<?php

namespace App\Http\Controllers;

use App\Salario;
use App\Vacante;
use App\Categoria;
use App\Ubicacion;
use App\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$vacantes = Auth::user()->vacantes;

        $vacantes = Vacante::latest()->where('user_id', Auth::user()->id)->simplePaginate(3);
        return view('vacantes.index')->with('vacantes', $vacantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Consultas
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.create', compact('categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validacion

        $data = $request->validate([
            'titulo' => 'required|min:8',
            'categoria' => 'required',
            'ubicacion' => 'required',
            'experiencia' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        // Almacenar en la BD
        Auth::user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'descripcion' => $data['descripcion'],
            'skills' => $data['skills'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario'],
        ]);

        return redirect()->action('VacanteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        // if ($vacante->activa === 0) {
        //     return abort(404);
        // }
        return view('vacantes.show')->with('vacante', $vacante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {
        // Policy para evitar que otra persona edite
        $this->authorize('view', $vacante);
        // Consultas
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.edit', compact('vacante', 'categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {
        // Policy para evitar que otra persona edite
        $this->authorize('update', $vacante);

        $data = $request->validate([
            'titulo' => 'required|min:8',
            'categoria' => 'required',
            'ubicacion' => 'required',
            'experiencia' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required'
        ]);

        $vacante->titulo = $data['titulo'];
        $vacante->skills = $data['skills'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];

        $vacante->save();

        // Redireccionar

        return redirect()->route('vacantes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante, Request $request)
    {
        // return response()->json($vacante);
        // return response()->json($request);

        $vacante->delete();

        return response()->json(['mensaje' => 'Se elimino la vacante ' . $vacante->titulo]);
    }

    /* ------------------------------ Campos extras ----------------------------- */

    public function imagen(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/vacantes'), $nombreImagen);

        return response()->json(['correcto' => $nombreImagen]);
    }

    // Borrar imagen via Ajax

    public function borrarimagen(Request $request)
    {
        if ($request->ajax()) {
            $imagen = $request->get('imagen');

            if (File::exists('storage/vacantes/' . $imagen)) {
                File::delete('storage/vacantes/' . $imagen);
            }

            return response('Imagen eliminada', 200);
        }
    }

    // Cambia el estado de una vacante
    public function estado(Request $request, Vacante  $vacante)
    {
        // Leer nuevo estado y asignarlo
        $vacante->activa = $request->estado;

        // Guardarlo en la BD
        $vacante->save();

        return response()->json(['response' => 'Correcto']);
    }

    public function buscar(Request $request)
    {
        // Validar
        $data = $request->validate([
            'categoria' => 'required',
            'ubicacion' => 'required'
        ]);

        // Asignar valores
        $categoria_id = $data['categoria'];
        $ubicacion_id = $data['ubicacion'];

        $vacantes = Vacante::latest()->where('categoria_id', $categoria_id)->orWhere('ubicacion_id', $ubicacion_id)->get();

        $vacantes = Vacante::where([
            'categoria_id' => $categoria_id,
            'ubicacion_id' => $ubicacion_id
        ])->get();

        $categoria = Categoria::find($categoria_id);
        $ubicacion = Ubicacion::find($ubicacion_id);

        return view('buscar.index', compact('vacantes', 'categoria', 'ubicacion'));
    }

    public function resultados()
    {
        return 'mostrando resultados';
    }
}
