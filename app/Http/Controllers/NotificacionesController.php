<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    public function index(Request $request)
    {
        $notificaciones = auth()->user()->unreadNotifications;

        $notificaciones->markAsRead();

        return view('notificaciones.index', compact('notificaciones'));
    }
}
