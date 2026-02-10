@extends('admin.layout')

@section('title', 'Crear Usuario')
@section('page_title', 'Usuarios / Crear')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Crear Usuario</div>
        <div class="card-subtitle">Nuevo registro</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.usuarios.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="space-y-4" method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf

        <div>
          <label class="label">Nombre de usuario</label>
          <input class="input" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required>
        </div>

        <div>
          <label class="label">Contraseña</label>
          <input class="input" type="password" name="contrasena" required>
        </div>

        <div>
          <label class="label">Fecha fin (opcional)</label>
          <input class="input" type="date" name="fecha_fin" value="{{ old('fecha_fin') }}">
        </div>

        <div>
          <label class="label">Roles</label>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @foreach($roles as $r)
              <label class="flex items-center gap-2 p-3 border border-slate-200 rounded-xl bg-white">
                <input type="checkbox" name="roles[]" value="{{ $r->name }}"
                       @checked(in_array($r->name, old('roles', [])))>
                <span class="text-sm font-semibold">{{ $r->name }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
      </form>
    </div>
  </div>
@endsection
