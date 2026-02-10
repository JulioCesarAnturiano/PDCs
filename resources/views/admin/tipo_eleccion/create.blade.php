@extends('admin.layout')

@section('title', 'Crear Tipo Elección')
@section('page_title', 'Tipo Elección / Crear')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Crear Tipo Elección</div>
        <div class="card-subtitle">Nuevo registro</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.tipo_eleccion.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="space-y-4" method="POST" action="{{ route('admin.tipo_eleccion.store') }}">
        @csrf

        <div>
          <label class="label">Nombre</label>
          <input class="input" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div>
          <label class="label">Código</label>
          <input class="input" name="codigo" value="{{ old('codigo') }}" required>
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
      </form>
    </div>
  </div>
@endsection
