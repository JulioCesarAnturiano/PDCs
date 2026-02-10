@extends('admin.layout')

@section('title', 'Editar Mesa')
@section('page_title', 'Editar Mesa')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Editar Mesa</div>
        <div class="card-subtitle">{{ $item->codigo }}</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.mesas.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.mesas.update', $item->id_mesa) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
          <div class="field">
            <label class="label">Código</label>
            <input class="input" name="codigo" value="{{ old('codigo', $item->codigo) }}" required>
          </div>
          <div class="field">
            <label class="label">Nombre</label>
            <input class="input" name="nombre" value="{{ old('nombre', $item->nombre) }}">
          </div>
        </div>

        <div class="field">
          <label class="label">Recinto</label>
          <select class="select" name="id_recinto" required>
            @foreach($recintos as $r)
              <option value="{{ $r->id_geografico }}" @selected(old('id_recinto', $item->id_recinto)==$r->id_geografico)>
                {{ $r->nombre }} ({{ $r->codigo }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-row">
          <div class="field">
            <label class="label">Número de personas</label>
            <input class="input" type="number" min="0" name="numero_personas" value="{{ old('numero_personas', $item->numero_personas) }}" required>
          </div>
          <div class="field">
            <label class="label">Activa</label>
            <select class="select" name="activa" required>
              <option value="1" @selected(old('activa', (string)$item->activa)==='1')>Sí</option>
              <option value="0" @selected(old('activa', (string)$item->activa)==='0')>No</option>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="label">Descripción</label>
          <textarea class="textarea" name="descripcion">{{ old('descripcion', $item->descripcion) }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
      </form>
    </div>
  </div>
@endsection
