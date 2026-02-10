@extends('admin.layout')

@section('title', 'Crear Usuario')
@section('page_title', 'Usuarios / Crear')

@push('styles')
<style>
  /* Extra mínimo para que el error de roles no quede pegado */
  .roles-error-pad{ padding:0 14px 14px; }
</style>
@endpush

@section('content')
  <div class="page">
    {{-- Header --}}
    <div class="page-head">
      <div>
        <h1 class="page-title">Crear Usuario</h1>
        <p class="page-sub">Nuevo registro</p>
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
          <p class="card-sub">Completa la información y asigna roles</p>
        </div>
      </div>

      <div class="card-body">
        <form class="form" method="POST" action="{{ route('admin.usuarios.guardar') }}" id="userForm">
          @csrf

          <div class="form-grid">
            {{-- Nombre --}}
            <div class="field">
              <label class="label">Nombre de usuario <span class="req">*</span></label>

              <div class="control">
                <i class="fas fa-user"></i>
                <input
                  class="input"
                  name="nombre_usuario"
                  value="{{ old('nombre_usuario') }}"
                  placeholder="ejemplo: juan.perez"
                  required
                  autofocus
                >
              </div>

              @error('nombre_usuario')
                <p class="error">{{ $message }}</p>
              @enderror
            </div>

            {{-- Contraseña --}}
            <div class="field">
              <label class="label">Contraseña <span class="req">*</span></label>

              <div class="control control-action">
                <i class="fas fa-lock"></i>

                <input
                  class="input"
                  type="password"
                  name="contrasena"
                  placeholder="••••••••"
                  required
                  id="passwordInput"
                >

                <button class="control-btn" type="button" onclick="togglePasswordVisibility()">
                  <i class="fas fa-eye" id="passwordToggleIcon"></i>
                </button>
              </div>

              <div class="strength">
                <div class="strength-bar" id="passwordStrengthBar"></div>
              </div>

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
                  value="{{ old('fecha_fin') }}"
                  min="{{ date('Y-m-d') }}"
                >
              </div>

              <p class="hint">
                <i class="fas fa-info-circle"></i>
                Dejar vacío si no tiene fecha de expiración
              </p>

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
                <p class="section-sub">Seleccione uno o más roles</p>
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
                    @checked(in_array($r->name, old('roles', [])))
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
              <p class="error roles-error-pad">{{ $message }}</p>
            @enderror
          </div>

          {{-- Actions --}}
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-save"></i>
              Guardar
            </button>

            <button type="reset" class="btn btn-outline">
              <i class="fas fa-redo"></i>
              Limpiar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById('passwordInput');
    const icon = document.getElementById('passwordToggleIcon');

    if (!passwordInput || !icon) return;

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('passwordInput');
    const bar = document.getElementById('passwordStrengthBar');
    if (!input || !bar) return;

    input.addEventListener('input', function(e) {
      const password = e.target.value || '';
      let strength = 0;

      if (password.length >= 8) strength += 25;
      if (password.length >= 12) strength += 25;
      if (/[A-Z]/.test(password)) strength += 25;
      if (/[0-9]/.test(password)) strength += 25;

      bar.style.width = `${strength}%`;

      bar.classList.remove('is-weak', 'is-mid', 'is-strong');
      if (strength < 50) bar.classList.add('is-weak');
      else if (strength < 75) bar.classList.add('is-mid');
      else bar.classList.add('is-strong');
    });
  });
</script>
@endpush
