@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-screen-md mb-3">
        <div class="flex flex-wrap justify-center">
            <div class="md:w-1/2 order-2 md:order-1 px-3 md:px-0">
                <div class="w-full max-w-sm">
                    <div class="flex flex-col break-words bg-white border-2 rounded shadow-md">
    
                        <div class="font-semibold bg-blue-900 text-white text-center py-3 px-6 mb-0">
                            {{ __('Register') }}
                        </div>
    
                        <form class="w-full p-6" method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <div class="flex flex-wrap mb-6">
                                <label for="name" class="block text-gray-700 text-sm mb-2">
                                    {{ __('Name') }}:
                                </label>
    
                                <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                @error('name')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
    
                            <div class="flex flex-wrap mb-6">
                                <label for="email" class="block text-gray-700 text-sm mb-2">
                                    {{ __('E-Mail Address') }}:
                                </label>
    
                                <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                @error('email')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
    
                            <div class="flex flex-wrap mb-6">
                                <label for="password" class="block text-gray-700 text-sm mb-2">
                                    {{ __('Password') }}:
                                </label>
    
                                <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
    
                                @error('password')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
    
                            <div class="flex flex-wrap mb-6">
                                <label for="password-confirm" class="block text-gray-700 text-sm mb-2">
                                    {{ __('Confirm Password') }}:
                                </label>
    
                                <input id="password-confirm" type="password" class="form-input w-full" name="password_confirmation" required autocomplete="new-password">
                            </div>
    
                            <div class="flex flex-wrap">
                                <button type="submit" class="inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-teal-500 hover:bg-teal-700">
                                    {{ __('Register') }}
                                </button>
    
                                <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                                    {{ __('Already have an account?') }}
                                    <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </p>
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 order-1 text-center flex flex-col justify-center md:order-2 my-3 md:my-0">
                <h1 class="text-teal-500 text-3xl">Eres reclutador?</h1>
                <p class="text-xl mt-5 leading-7">Crea una cuenta totalmente gratis y comienza a publicar hasta 10 vacantes</p>
            </div>
            
        </div>
    </div>
@endsection
