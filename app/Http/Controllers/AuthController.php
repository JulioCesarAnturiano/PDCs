<?php

namespace App\Http\Controllers;

use App\Models\VotoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'nombre_usuario' => ['required', 'string'],
            'contrasena'     => ['required', 'string'],
        ]);

        $user = VotoUsuario::where('nombre_usuario', $credenciales['nombre_usuario'])->first();

        if (!$user || !Hash::check($credenciales['contrasena'], $user->contrasena)) {
            return back()
                ->withInput()
                ->with('error', 'Usuario no reconocido.');
        }

        // ⛔ Usuario vencido
        if ($user->fecha_fin && now()->greaterThan($user->fecha_fin)) {
            return back()
                ->withInput()
                ->with('error', 'Usuario vencido.');
        }

        // LOGIN EXACTO COMO EL OTRO SISTEMA
        Auth::login($user);
        $request->session()->regenerate();

        // Validar roles permitidos (IGUAL que tu otro sistema)
        if (!$user->hasAnyRole(['admin', 'operador'])) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withInput()
                ->with('error', 'Usuario no reconocido.');
        }

        return redirect()->intended('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
