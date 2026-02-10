@extends('admin.layout')

@section('title', 'Editar Usuario')
@section('page_title', 'Usuarios / Editar')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Editar Usuario</div>
        <div class="card-subtitle">{{ $usuario->nombre_usuario }}</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.usuarios.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="space-y-4" method="POST" action="{{ route('admin.usuarios.update', $usuario->id_usuario) }}">
        @csrf
        @method('PUT')

        <div>
          <label class="label">Nombre de usuario</label>
          <input class="input" name="nombre_usuario" value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}" required>
        </div>

        <div>
          <label class="label">Contraseña (opcional)</label>
          <input class="input" type="password" name="contrasena" placeholder="Dejar vacío para no cambiar">
        </div>

        <div>
          <label class="label">Fecha fin (opcional)</label>
          <input class="input" type="date" name="fecha_fin" value="{{ old('fecha_fin', optional($usuario->fecha_fin)->format('Y-m-d')) }}">
        </div>

        <div>
          <label class="label">Roles</label>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @foreach($roles as $r)
              <label class="flex items-center gap-2 p-3 border border-slate-200 rounded-xl bg-white">
                <input type="checkbox" name="roles[]" value="{{ $r->name }}"
                       @checked(in_array($r->name, old('roles', $rolesAsignados ?? [])))>
                <span class="text-sm font-semibold">{{ $r->name }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
      </form>
    </div>
  </div>
@endsection
