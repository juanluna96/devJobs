@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center">
            <div class="w-full max-w-sm px-3 md:px-0">
                <div class="flex flex-col break-words bg-white border-2 rounded shadow-md">

                    <div class="font-semibold bg-blue-900 text-white text-center py-3 px-6 mb-0">
                        {{ __('Login') }}
                    </div>

                    <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-700 text-sm mb-2">
                                {{ __('Password') }}:
                            </label>

                            <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" name="password" required>

                            @error('password')
                                <p class="bg-red-100 border-l-4 border-red-500 p-4 w-full text-red-500 text-sm italic mt-4" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex mb-6">
                            <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('Remember Me') }}</span>
                            </label>
                        </div>

                        <div class="flex flex-wrap items-center">
                            <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-gray-100 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                                    {{ __("Don't have an account?") }}
                                    <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
