<?php

namespace App\Http\Controllers;

use App\Models\VotoUsuario;
use App\Models\VotoTipoEleccion;
use App\Models\VotoGeografico;
use App\Models\VotoMesa;
use Spatie\Permission\Models\Role;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'usuarios' => VotoUsuario::count(),
            'roles' => Role::count(),
            'tipo_eleccion' => VotoTipoEleccion::count(),
            'geografico' => VotoGeografico::count(),
            'mesas' => VotoMesa::count(),
        ];

        // Cards dummy / actividad reciente (puedes cambiar luego)
        $activity = [
            ['label' => 'Último ingreso', 'value' => now()->format('d/m/Y H:i')],
            ['label' => 'Estado', 'value' => 'Sistema operativo'],
        ];

        return view('admin.dashboard', compact('stats', 'activity'));
    }
}
