@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Nueva vacante</h1>

    <form action="" method="POST" class="max-w-xl mx-auto my-10 px-3 md:px-0">
        <div class="my-3">
            <label for="titulo" class="block text-gray-700 text-sm mb-2"> Titulo vacante: </label>
            <input id="titulo" type="titulo" class="form-input w-full @error('titulo') border-red-500 @enderror" name="titulo" value="{{ old('titulo') }}" required autocomplete="email" autofocus>

            @error('titulo')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="my-3">
            <label for="categoria" class="block text-gray-700 text-sm mb-2"> Categoria: </label>
            <select name="categoria" id="categoria" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-white">
                <option disabled selected>-- Selecciona --</option>

                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>

            @error('titulo')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit" class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">Publicar vacante</button>
    </form>
@endsection