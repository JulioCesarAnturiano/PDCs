@extends('admin.layout')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
    <div class="card">
      <div class="card-body">
        <div class="text-xs text-slate-500">Usuarios</div>
        <div class="text-3xl font-black text-slate-900">{{ $stats['usuarios'] ?? 0 }}</div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="text-xs text-slate-500">Roles</div>
        <div class="text-3xl font-black text-slate-900">{{ $stats['roles'] ?? 0 }}</div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="text-xs text-slate-500">Tipo Elección</div>
        <div class="text-3xl font-black text-slate-900">{{ $stats['tipo_eleccion'] ?? 0 }}</div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="text-xs text-slate-500">Geográfico</div>
        <div class="text-3xl font-black text-slate-900">{{ $stats['geografico'] ?? 0 }}</div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="text-xs text-slate-500">Mesas</div>
        <div class="text-3xl font-black text-slate-900">{{ $stats['mesas'] ?? 0 }}</div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Actividad</div>
          <div class="card-subtitle">Resumen rápido (dummy)</div>
        </div>
      </div>
      <div class="card-body space-y-2">
        @foreach($activity ?? [] as $a)
          <div class="flex items-center justify-between">
            <div class="text-sm text-slate-600">{{ $a['label'] }}</div>
            <div class="text-sm font-semibold text-slate-900">{{ $a['value'] }}</div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Accesos</div>
          <div class="card-subtitle">Atajos</div>
        </div>
      </div>
      <div class="card-body flex flex-wrap gap-2">
        <a class="btn btn-primary" href="{{ route('admin.usuarios.index') }}">Usuarios</a>
        <a class="btn btn-outline" href="{{ route('admin.roles.index') }}">Roles</a>
        <a class="btn btn-outline" href="{{ route('admin.tipo_eleccion.index') }}">Tipo Elección</a>
        <a class="btn btn-outline" href="{{ route('admin.geografico.index') }}">Geográfico</a>
        <a class="btn btn-outline" href="{{ route('admin.mesas.index') }}">Mesas</a>
        <a class="btn btn-outline" href="{{ route('admin.votos.index') }}">Votos</a>
      </div>
    </div>
  </div>
@endsection
