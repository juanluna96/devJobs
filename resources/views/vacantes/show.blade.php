@extends('layouts.app')

@section('content')
    <h1 class="text-3xl text-center mt-10">{{ $vacante->titulo }}</h1>

    <div class="mt-10 mb-20 md:flex items-start">
        <div class="md:w-3/5">
            <p class="block text-gray-700 font-bold my-2">
                Publicado: <span class="font-normal">{{ Str::ucfirst($vacante->created_at->diffForHumans()) }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Categoria: <span class="font-normal">{{ $vacante->categoria->nombre }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Salario: <span class="font-normal">{{ $vacante->salario->nombre }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Ubicacion: <span class="font-normal">{{ $vacante->ubicacion->nombre }}</span>
            </p>
            <p class="block text-gray-700 font-bold my-2">
                Experiencia: <span class="font-normal">{{ $vacante->experiencia->nombre }}</span>
            </p>

            <h2 class="text-2xl text-center mt-10 text-gray-700 mb-10">Conocimientos y tecnologias</h2>
            @php
                $arraySkills = explode(',', $vacante->skills)
            @endphp
            @foreach($arraySkills as $skill)
                <p class="inline-block border border-gray-500 py-2 px-8 text-gray-700 font-bold my-2 rounded bg-green-50">
                    <span class="font-normal">{{ $skill }}</span>
                </p>
            @endforeach

            <div class="descripcion mt-10 mb-5 text-justify">
                {!! $vacante->descripcion !!}
            </div>
        </div>
        <div class="md:w-2/5"></div>
    </div>
@endsection