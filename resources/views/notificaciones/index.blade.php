@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Notificaciones</h1>
    @if (count($notificaciones) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach ($notificaciones as $notificacion)
                @php
                $data = $notificacion->data;
                @endphp
                <li class="p-5 border border-gray-400 mb-5">
                    <div class="mb-4">
                        Tienes un candidato nuevo en:
                        <span class="font-bold">
                            {{ $data['vacante'] }}
                        </span>
                    </div>
                    <div class="mb-4">
                        Aplico hace:
                        <span class="font-bold">
                            {{ $notificacion->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="text-center block">
                        <a href="{{ route('candidatos.index', ['vacante_id' => $vacante->id]) }}"
                            class="bg-teal-500 px-6 py-3 inline-block text-xs font=bold uppercase text-white">
                            Ver candidatos
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center mt-5">No hay notificaciones</p>
    @endif
@endsection
