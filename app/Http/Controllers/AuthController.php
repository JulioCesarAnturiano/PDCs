<?php

namespace App\Http\Controllers;

use App\Models\VotoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'nombre_usuario' => ['required','string'],
            'contrasena' => ['required','string'],
        ]);

        $user = VotoUsuario::where('nombre_usuario', $data['nombre_usuario'])->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Usuario no encontrado.');
        }

        // si hay fecha_fin y ya pasó, bloquear
        if (!empty($user->fecha_fin) && now()->toDateString() > $user->fecha_fin) {
            return back()->withInput()->with('error', 'Usuario vencido.');
        }

        // Ajusta esto si en tu BD la contraseña NO está hasheada aún.
        if (!Hash::check($data['contrasena'], $user->contrasena)) {
            return back()->withInput()->with('error', 'Credenciales incorrectas.');
        }

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Bienvenido.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada.');
    }
}
