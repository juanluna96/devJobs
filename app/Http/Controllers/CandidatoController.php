<?php

namespace App\Http\Controllers;

use App\Candidato;
use App\Vacante;
use App\Notifications\NuevoCandidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtener el id actual
        $vacante_id = $request->vacante_id;

        // Obtener los candidatos y la vacante
        $vacante = Vacante::findOrFail($vacante_id);

        $this->autorize('view', $vacante);

        return view('candidatos.index', compact('vacante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    Validacion
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'cv' => 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required'
        ]);

        // Almacenar archivo pdf

        if ($request->file('cv')) {
            $archivo = $request->file('cv');
            $nombreArchivo = time() . '.' . $archivo->extension();

            $ubicacion = public_path('storage/cv');
            $archivo->move($ubicacion, $nombreArchivo);
        }

        // Tercera forma
        $candidato = new Candidato();
        $candidato->fill($data);
        $candidato->cv = $nombreArchivo;

        $candidato->save();

        $vacante = Vacante::find($data['vacante_id']);
        $reclutador = $vacante->reclutador;

        $reclutador->notify(new NuevoCandidato($vacante->titulo, $vacante->id));

        /*
            // Primera forma para guardar
            $candidato = new Candidato();
            $candidato->nombre = $data['nombre'];
            $candidato->email = $data['email'];
            $candidato->vacante_id = $data['vacante_id'];
            $candidato->cv = '123.pdf';
        */

        /*
            // Segunda forma
            $candidato = new Candidato($data);
            $candidato->cv = '123.pdf';
        */


        return back()->with('message', 'Tus datos se han enviado correctamente! Te deseamos suerte');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
