@extends('layouts.app')

@section('navegacion')
    @include('ui.categoriasnav')
@endsection

@section('content')
    @if (count($vacantes) > 0)
        <h1 class="text-3xl text-gray-700 m-0">
            Resultados de:
            {{ $categoria->nombre . ' en ' . Str::lower($ubicacion->nombre) }}
        </h1>
        <div class="my-10 bg-gray-200 p-10 shadow rounded">
            <ul class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($vacantes as $vacante)
                    <li class="p-10 border border-gray-300 bg-white shadow">
                        <h2 class="text-2xl font-bold text-teal-700">{{ $vacante->titulo }}</h2>
                        <p class="block text-gray-700 font-normal my-2">
                            {{ $vacante->categoria->nombre }}
                        </p>
                        <p class="block text-gray-700 font-normal my-2">
                            Ubicacion: <span class="font-bold">{{ $vacante->ubicacion->nombre }}</span>
                        </p>
                        <p class="block text-gray-700 font-normal my-2">
                            Experiencia: <span class="font-bold">{{ $vacante->experiencia->nombre }}</span>
                        </p>
                        <a class="bg-teal-500 text-gray-100 mt-2 px-4 py-2 inline-block rounded font-bold text-sm"
                            href="{{ route('vacantes.show', ['vacante' => $vacante->id]) }}">Ver vacante</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-center text-gray-700">No hay vacantes que concuerden con tu busqueda</p>
    @endif
@endsection
