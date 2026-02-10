@extends('admin.layout')

@section('title', 'Editar Tipo Elección')
@section('page_title', 'Tipo Elección / Editar')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Editar Tipo Elección</div>
        <div class="card-subtitle">{{ $item->nombre }}</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.tipo_eleccion.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="space-y-4" method="POST" action="{{ route('admin.tipo_eleccion.update', $item->id_tipo_eleccion) }}">
        @csrf
        @method('PUT')

        <div>
          <label class="label">Nombre</label>
          <input class="input" name="nombre" value="{{ old('nombre', $item->nombre) }}" required>
        </div>

        <div>
          <label class="label">Código</label>
          <input class="input" name="codigo" value="{{ old('codigo', $item->codigo) }}" required>
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
      </form>
    </div>
  </div>
@endsection
