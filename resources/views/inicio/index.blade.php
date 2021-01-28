@extends('layouts.app')

@section('navegacion')
    @include('ui.categoriasnav')
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row shadow bg-white">
        <div class="lg:w-1/2 px-8 lg:px-12 py-12 lg:py-24">
            <p class="text-2xl text-gray-700">
                Dev<span class="font-bold">Jobs</span>
            </p>
            <h1 class="mt-2 sm:mt-4 text-3xl text-gray-700 leading-tight">
                Encuentra un trabajo remoto o en tu pais<span class="text-teal-500 font-bold block">Para
                    Desarrolladores/Diseñadores
                    web</span>
            </h1>
        </div>
        <div class="block lg:w-1/2">
            <img class="inset-0 h-full w-full object-cover object-right" src="/img/4321.jpg" alt="DevJobs" srcset="">
        </div>
    </div>

    <div class="my-10 bg-gray-200 p-10 shadow rounded">
        <h1 class="text-3xl text-gray-700 m-0">
            Nuevas
            <span class="font-bold">vacantes</span>
        </h1>
        <ul class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
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
@endsection
