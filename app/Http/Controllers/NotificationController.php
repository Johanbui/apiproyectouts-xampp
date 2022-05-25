<?php

namespace App\Http\Controllers;

use App\Models\Notificaciones;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getAll(Request $request)
    {
        $id_usuario = $request->get('id_usuario');

        $notifications = Notificaciones::query()
            ->join('notificaciones_usuarios', 'notificaciones.id', '=', 'notificaciones_usuarios.id_notificacion')
            ->where([
                ['id_usuario', $id_usuario],
                ['visto', 0]
            ])
            ->get();

        $countNotifications = Notificaciones::query()
            ->count();

        return response()->json([
            "data" => $notifications,
            "count" => $countNotifications,
            "code" => 20000
        ]);
    }

    public function markAsReaded(Request $request)
    {
        $id_usuario = $request->get('id_usuario');

        $notifications = Notificaciones::query()
            ->join('notificaciones_usuarios', 'notificaciones.id', '=', 'notificaciones_usuarios.id_notificacion')
            ->where([
                ['id_usuario', $id_usuario],
                ['visto', 0]
            ])
            ->update(['visto' => 1]);

        return response()->json([
            "data" => $notifications,
            "code" => 20000
        ]);
    }
}
