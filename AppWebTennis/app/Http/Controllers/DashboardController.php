<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function __invoke()
    {
        // Obtener sesiones activas de usuarios
        $sessions = DB::table('sessions')->get();
        $usersLoggedIn = [];

        foreach ($sessions as $session) {
            if ($session->user_id && !in_array($session->user_id, $usersLoggedIn)) {
                $usersLoggedIn[] = $session->user_id;
            }
        }

        $usuariosLogueados = User::whereIn('id', $usersLoggedIn)->get();

        return view('dashboard', [
            'totalUsers'   => User::count(),
            'activeUsers'  => User::where('estado', 'activo')->count(),
            'rolesCount'   => Role::count(),
            'lastUser'     => User::latest()->first(),
            'admins'       => User::role('admin')->count(),
            'usuariosLogueados'=> $usuariosLogueados,
        ]);
    }
}
