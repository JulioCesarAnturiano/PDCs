<?php

namespace App\Http\Controllers;

use App\Models\VotoUsuario;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $usuariosTotal = VotoUsuario::count();
        return view('admin.dashboard', compact('usuariosTotal'));
    }
}
