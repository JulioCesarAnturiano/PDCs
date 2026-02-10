<?php

namespace App\Http\Controllers;

use App\Models\VotoUsuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class VotoUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = VotoUsuario::orderBy('id_usuario', 'desc')->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
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
            'contrasena' => ['required','string','min:4'],
            'fecha_fin' => ['nullable','date'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string'],
        ]);

        $user = new VotoUsuario();
        $user->nombre_usuario = $data['nombre_usuario'];
        $user->contrasena = $data['contrasena']; // se hashea por mutator
        $user->fecha_fin = $data['fecha_fin'] ?? null;
        $user->save();

        $user->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = VotoUsuario::findOrFail($id);
        $roles = Role::orderBy('name')->get();
        $rolesAsignados = $usuario->roles->pluck('name')->toArray();

        return view('admin.usuarios.edit', compact('usuario','roles','rolesAsignados'));
    }

    public function update(Request $request, $id)
    {
        $usuario = VotoUsuario::findOrFail($id);

        $data = $request->validate([
            'nombre_usuario' => [
                'required','string','max:150',
                Rule::unique('voto_usuario','nombre_usuario')->ignore($usuario->id_usuario, 'id_usuario')
            ],
            'contrasena' => ['nullable','string','min:4'],
            'fecha_fin' => ['nullable','date'],
            'roles' => ['nullable','array'],
            'roles.*' => ['string'],
        ]);

        $usuario->nombre_usuario = $data['nombre_usuario'];
        $usuario->fecha_fin = $data['fecha_fin'] ?? null;

        if (!empty($data['contrasena'])) {
            $usuario->contrasena = $data['contrasena']; // mutator bcrypt
        }

        $usuario->save();
        $usuario->syncRoles($data['roles'] ?? []);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = VotoUsuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado (soft delete).');
    }
}
