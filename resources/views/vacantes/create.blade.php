@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.css" integrity="sha512-iWJx03fFJWrXXXI6ctpoVaLkB6a4yf9EHNURLEEsLxGyup43eF6LrD3FSPdt1FKnGSE8Zp7JZYEDbATHf1Yx8Q==" crossorigin="anonymous" />
@endsection

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

            @error('categoria')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="my-3">
            <label for="experiencia" class="block text-gray-700 text-sm mb-2"> Experiencias: </label>
            <select name="experiencia" id="experiencia" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-white">
                <option disabled selected>-- Selecciona --</option>

                @foreach ($experiencias as $experiencia)
                    <option value="{{$experiencia->id}}">{{ $experiencia->nombre }}</option>
                @endforeach
            </select>

            @error('experiencia')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="my-3">
            <label for="ubicacion" class="block text-gray-700 text-sm mb-2"> Ubicaciones: </label>
            <select name="ubicacion" id="ubicacion" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-white">
                <option disabled selected>-- Selecciona --</option>

                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{$ubicacion->id}}">{{ $ubicacion->nombre }}</option>
                @endforeach
            </select>

            @error('ubicacion')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="my-3">
            <label for="salario" class="block text-gray-700 text-sm mb-2"> Salario: </label>
            <select name="salario" id="salario" class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-white">
                <option disabled selected>-- Selecciona --</option>

                @foreach ($salarios as $salario)
                    <option value="{{$salario->id}}">{{ $salario->nombre }}</option>
                @endforeach
            </select>

            @error('salario')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="my-3">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2"> Descipcion del puesto: </label>
            <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>

            <input type="hidden" name="descripcion" id="descripcion">

            @error('descripcion')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit" class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">Publicar vacante</button>
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded',() => {
            const editor = new MediumEditor('.editable',{
                toolbar:{
                    buttons:['bold','italic','underline','quote','anchor','justifyLeft','justifyCenter','justifyRight','justifyFull','orderedList','unorderedList','h2','h3'],
                    static: true,
                    sticky:true,
                },
                placeholder:{
                    text:'Informacion de la vacante'
                }
            });
            editor.subscribe('editableInput',function (eventObj, editable) {
                const contenido = editor.getContent();
                document.querySelector('#descripcion').value=contenido;
            });
        })
    </script>
@endsection