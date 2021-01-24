@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Candidatos de {{ $vacante->titulo }}</h1>
    @if (count($vacante->candidatos) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach ($vacante->candidatos as $candidato)
                <li class="p-5 border border-gray-400 mb-5">
                    <p class="mb-4"> Nombre:
                        <span class="font-bold">{{ $candidato->nombre }}</span>
                    </p>
                    <p class="mb-4"> Email:
                        <span class="font-bold">{{ $candidato->email }}</span>
                    </p>
                    <div class="block text-center">
                        <a class="bg-teal-500 px-4 py-3 inline-block text-xs font=bold uppercase text-white"
                            href="/storage/cv/{{ $candidato->cv }}" target="_blank">Ver CV</a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center mt-5">No hay candidatos</p>
    @endif
@endsection
