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


        /**
         * Inventario por Marca y Cantidad de Productos en Sucursal
         */
        $inventarioPorSucursal = DB::table('inventarios')
            ->join('variantes', 'inventarios.variante_id', '=', 'variantes.id')
            ->join('productos', 'variantes.producto_id', '=', 'productos.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->join('sucursales', 'inventarios.sucursal_id', '=', 'sucursales.id')
            ->select(
                'sucursales.nombre as sucursal',
                'marcas.nombre as marca',
                'productos.nombre as producto',
                DB::raw('SUM(inventarios.stock_actual) as stock_total')
            )
            ->groupBy(
                'sucursales.nombre',
                'marcas.nombre',
                'productos.nombre'
            )
            ->having('stock_total', '>', 1)
            ->orderBy('sucursales.nombre')
            ->orderBy('marcas.nombre')
            ->orderBy('productos.nombre')
            ->get()
            ->groupBy(['sucursal', 'marca']);

        return view('dashboard', [
            'totalUsers'   => User::count(),
            'activeUsers'  => User::where('estado', 'activo')->count(),
            'rolesCount'   => Role::count(),
            'lastUser'     => User::latest()->first(),
            'admins'       => User::role('admin')->count(),
            'usuariosLogueados' => $usuariosLogueados,
            'inventarioPorSucursal' => $inventarioPorSucursal,
        ]);
    }
}
