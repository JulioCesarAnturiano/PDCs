<?php

namespace App\Http\Controllers;

use App\Models\VotoUsuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class VotoUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $usuarios = VotoUsuario::query()
            ->when($q, fn($qq) => $qq->where('nombre_usuario', 'like', "%{$q}%"))
            ->orderByDesc('id_usuario')
            ->paginate(10)
            ->withQueryString();

        return view('admin.usuarios.index', compact('usuarios', 'q'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_usuario' => ['required','string','max:150','unique:voto_usuario,nombre_usuario'],
            'contrasena' => ['required','string','min:6'],
            'fecha_fin' => ['nullable','date'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string','exists:roles,name'],
        ]);

        $usuario = VotoUsuario::create([
            'nombre_usuario' => $data['nombre_usuario'],
            'contrasena' => $data['contrasena'], // mutator encripta
            'fecha_fin' => $data['fecha_fin'] ?? null,
        ]);

        $usuario->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(VotoUsuario $usuario)
    {
        $roles = Role::orderBy('name')->get();
        $usuarioRoles = $usuario->roles->pluck('name')->toArray();

        return view('admin.usuarios.edit', compact('usuario', 'roles', 'usuarioRoles'));
    }

    public function update(Request $request, VotoUsuario $usuario)
    {
        $data = $request->validate([
            'nombre_usuario' => [
                'required','string','max:150',
                Rule::unique('voto_usuario','nombre_usuario')->ignore($usuario->id_usuario, 'id_usuario')
            ],
            'contrasena' => ['nullable','string','min:6'],
            'fecha_fin' => ['nullable','date'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string','exists:roles,name'],
        ]);

        $usuario->nombre_usuario = $data['nombre_usuario'];
        $usuario->fecha_fin = $data['fecha_fin'] ?? null;

        if (!empty($data['contrasena'])) {
            $usuario->contrasena = $data['contrasena'];
        }

        $usuario->save();
        $usuario->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(VotoUsuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
