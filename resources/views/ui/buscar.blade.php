<h2 class="my-10 text-2xl text-gray-700">Busca una vacante</h2>

<form action="">
    <div class="md:flex">
        <div class="my-3 mr-3 md:w-1/2">
            <label for="categoria" class="block text-gray-700 text-sm mb-2"> Categoria: </label>
            <select name="categoria" id="categoria"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-white">
                <option disabled selected>-- Selecciona --</option>

                @foreach ($categorias as $categoria)
                    <option {{ old('categoria') == $categoria->id ? 'selected' : '' }} value="{{ $categoria->id }}">
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>

            @error('categoria')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-2" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="my-3 md:w-1/2">
            <label for="ubicacion" class="block text-gray-700 text-sm mb-2"> Ubicaciones: </label>
            <select name="ubicacion" id="ubicacion"
                class="block appearance-none w-full border border-gray-200 text-gray-700 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 p-3 bg-white">
                <option disabled selected>-- Selecciona --</option>

                @foreach ($ubicaciones as $ubicacion)
                    <option {{ old('ubicacion') == $ubicacion->id ? 'selected' : '' }} value="{{ $ubicacion->id }}">
                        {{ $ubicacion->nombre }}
                    </option>
                @endforeach
            </select>

            @error('ubicacion')
                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-2" role="alert">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <button type="submit"
        class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline-none focus:shadow-outline uppercase mt-5">
        Buscar vacantes</button>
</form>
