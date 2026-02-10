@extends('admin.layout')

@section('title', 'Editar Usuario')
@section('page_title', 'Usuarios / Editar')

@section('content')
  <div class="page">
    {{-- Header --}}
    <div class="page-head">
      <div>
        <h1 class="page-title">Editar Usuario</h1>
        <p class="page-sub">{{ $usuario->nombre_usuario }}</p>
      </div>

      <a class="btn btn-outline btn-sm" href="{{ route('admin.usuarios.index') }}">
        <i class="fas fa-arrow-left"></i>
        Volver
      </a>
    </div>

    {{-- Card --}}
    <div class="card">
      <div class="card-head">
        <div>
          <h2 class="card-title">Datos del usuario</h2>
          <p class="card-sub">Actualiza la información y roles</p>
        </div>
      </div>

      <div class="card-body">
        <form class="form" method="POST" action="{{ route('admin.usuarios.actualizar', $usuario->id_usuario) }}">
          @csrf
          @method('PUT')

          {{-- Grid --}}
          <div class="form-grid">
            {{-- Nombre --}}
            <div class="field">
              <label class="label">
                Nombre de usuario <span class="req">*</span>
              </label>

              <div class="control">
                <i class="fas fa-user"></i>
                <input
                  class="input"
                  name="nombre_usuario"
                  value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}"
                  required
                >
              </div>

              @error('nombre_usuario')
                <p class="error">{{ $message }}</p>
              @enderror
            </div>

            {{-- Contraseña --}}
            <div class="field">
              <label class="label">Contraseña (opcional)</label>

              <div class="control">
                <i class="fas fa-lock"></i>
                <input
                  class="input"
                  type="password"
                  name="contrasena"
                  placeholder="Dejar vacío para no cambiar"
                >
              </div>

              <p class="hint">
                <i class="fas fa-info-circle"></i>
                Solo llenar si desea cambiar la contraseña
              </p>

              @error('contrasena')
                <p class="error">{{ $message }}</p>
              @enderror
            </div>

            {{-- Fecha fin --}}
            <div class="field">
              <label class="label">Fecha fin (opcional)</label>

              <div class="control">
                <i class="fas fa-calendar"></i>
                <input
                  class="input"
                  type="date"
                  name="fecha_fin"
                  value="{{ old('fecha_fin', $usuario->fecha_fin ? \Carbon\Carbon::parse($usuario->fecha_fin)->format('Y-m-d') : '') }}"
                >
              </div>

              @error('fecha_fin')
                <p class="error">{{ $message }}</p>
              @enderror
            </div>
          </div>

          {{-- Roles --}}
          <div class="section">
            <div class="section-head">
              <div class="section-ico"><i class="fas fa-user-tag"></i></div>
              <div>
                <h3 class="section-title">Roles asignados</h3>
                <p class="section-sub">Modifica los roles del usuario</p>
              </div>
            </div>

            <div class="roles-grid">
              @foreach($roles as $r)
                <label class="role">
                  <input
                    class="role-input"
                    type="checkbox"
                    name="roles[]"
                    value="{{ $r->name }}"
                    @checked(in_array($r->name, old('roles', $rolesAsignados ?? [])))
                  >

                  <div class="role-main">
                    <div class="role-ico">
                      <i class="fas {{ $r->icon ?? 'fa-user-tag' }}"></i>
                    </div>

                    <div class="role-txt">
                      <div class="role-name">{{ $r->name }}</div>
                      <div class="role-sub">{{ $r->permissions_count ?? 0 }} permisos</div>
                    </div>
                  </div>

                  <div class="role-check">
                    <i class="fas fa-check"></i>
                  </div>
                </label>
              @endforeach
            </div>

            @error('roles')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          {{-- Info --}}
          <div class="info">
            <div class="info-head">
              <i class="fas fa-info-circle"></i>
              Información del usuario
            </div>

            <div class="info-body">
              <div class="info-row">
                <span class="info-key">Creado:</span>
                <span class="info-val">{{ $usuario->created_at->format('d/m/Y H:i') }}</span>
              </div>
              <div class="info-row">
                <span class="info-key">Actualizado:</span>
                <span class="info-val">{{ $usuario->updated_at->format('d/m/Y H:i') }}</span>
              </div>
            </div>
          </div>

          {{-- Actions --}}
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-save"></i>
              Actualizar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
