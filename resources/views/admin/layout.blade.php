<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin')</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .card { background:#fff; border:1px solid #e5e7eb; border-radius:16px; box-shadow:0 10px 20px rgba(0,0,0,.04); }
    .btn { display:inline-flex; align-items:center; justify-content:center; gap:.5rem; padding:.55rem .9rem; border-radius:12px; font-weight:600; border:1px solid transparent; }
    .btn-primary { background:#111827; color:#fff; }
    .btn-primary:hover { background:#0b1220; }
    .btn-outline { background:#fff; border-color:#e5e7eb; color:#111827; }
    .btn-outline:hover { background:#f9fafb; }
    .input, .select, .textarea { width:100%; border:1px solid #e5e7eb; border-radius:12px; padding:.6rem .75rem; background:#fff; }
    .textarea { min-height:100px; }
    .label { display:block; font-size:.875rem; color:#374151; margin-bottom:.35rem; font-weight:600; }
    .table { width:100%; border-collapse:collapse; }
    .table th { text-align:left; font-size:.8rem; color:#6b7280; padding:.75rem; border-bottom:1px solid #e5e7eb; }
    .table td { padding:.75rem; border-bottom:1px solid #f1f5f9; }
    .badge { font-size:.75rem; padding:.15rem .5rem; border-radius:999px; border:1px solid #e5e7eb; background:#f9fafb; color:#111827; }
    .alert { border-radius:16px; padding:14px 16px; border:1px solid; display:flex; gap:12px; }
    .alert-success { background:#ecfdf5; border-color:#a7f3d0; color:#065f46; }
    .alert-error { background:#fef2f2; border-color:#fecaca; color:#991b1b; }
    .alert-info { background:#eff6ff; border-color:#bfdbfe; color:#1e40af; }
    .card-header { padding:18px 18px 10px 18px; display:flex; align-items:center; justify-content:space-between; }
    .card-title { font-size:1.05rem; font-weight:800; color:#111827; }
    .card-subtitle { font-size:.85rem; color:#6b7280; }
    .card-body { padding:18px; }
    .navlink { display:flex; align-items:center; gap:.6rem; padding:.55rem .75rem; border-radius:12px; color:#111827; }
    .navlink:hover { background:#f3f4f6; }
    .navlink-active { background:#111827; color:#fff; }
    .navlink-active:hover { background:#0b1220; color:#fff; }
  </style>
</head>
<body class="bg-slate-50">
  <div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-white border-r border-slate-200 p-4 hidden md:block">
      <div class="mb-4">
        <div class="text-lg font-black text-slate-900">PDC</div>
        <div class="text-xs text-slate-500">Panel Administrador</div>
      </div>

      @php
        $is = fn($name) => request()->routeIs($name);
        $lnk = fn($name) => $is($name) ? 'navlink navlink-active' : 'navlink';
      @endphp

      <nav class="space-y-1">
        <a class="{{ $lnk('admin.dashboard') }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="{{ $lnk('admin.usuarios.index') }}" href="{{ route('admin.usuarios.index') }}">Usuarios</a>
        <a class="{{ $lnk('admin.roles.index') }}" href="{{ route('admin.roles.index') }}">Roles</a>
        <a class="{{ $lnk('admin.tipo_eleccion.index') }}" href="{{ route('admin.tipo_eleccion.index') }}">Tipo Elección</a>
        <a class="{{ $lnk('admin.geografico.index') }}" href="{{ route('admin.geografico.index') }}">Geográfico</a>
        <a class="{{ $lnk('admin.mesas.index') }}" href="{{ route('admin.mesas.index') }}">Mesas</a>
        <a class="{{ $lnk('admin.votos.index') }}" href="{{ route('admin.votos.index') }}">Votos</a>
      </nav>

      <div class="mt-6 pt-4 border-t border-slate-200">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-outline w-full" type="submit">Cerrar sesión</button>
        </form>
      </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1">
      {{-- TOPBAR --}}
      <div class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
          <div>
            <div class="text-sm text-slate-500">@yield('page_title', 'Admin')</div>
            <div class="text-xs text-slate-400">{{ now()->format('d/m/Y H:i') }}</div>
          </div>

          <div class="text-sm text-slate-600">
            @php
              $u = auth()->user();
              $name = $u->nombre_usuario ?? $u->name ?? 'Usuario';
            @endphp
            <span class="font-semibold text-slate-800">{{ $name }}</span>
          </div>
        </div>
      </div>

      {{-- CONTENT --}}
      <div class="max-w-7xl mx-auto px-4 md:px-8 py-6 space-y-4">

        {{-- Mensajes success/error --}}
        @if(session('success'))
          <div class="alert alert-success">
            <div>
              <div class="font-extrabold">OK</div>
              <div class="text-sm">{{ session('success') }}</div>
            </div>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-error">
            <div>
              <div class="font-extrabold">Error</div>
              <div class="text-sm">{{ session('error') }}</div>
            </div>
          </div>
        @endif

        {{-- Errores de validación --}}
        @if($errors->any())
          <div class="alert alert-error">
            <div>
              <div class="font-extrabold">Revisa los campos</div>
              <ul class="text-sm list-disc ml-5">
                @foreach($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>
