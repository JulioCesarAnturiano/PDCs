@extends('admin.layout')

@section('title', 'Nueva Mesa')
@section('page_title', 'Nueva Mesa')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Crear Mesa</div>
        <div class="card-subtitle">Asociar a un recinto</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.mesas.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.mesas.store') }}">
        @csrf

        <div class="form-row">
          <div class="field">
            <label class="label">Código (único)</label>
            <input class="input" name="codigo" value="{{ old('codigo') }}" required>
          </div>
          <div class="field">
            <label class="label">Nombre (opcional)</label>
            <input class="input" name="nombre" value="{{ old('nombre') }}">
          </div>
        </div>

        <div class="field">
          <label class="label">Recinto</label>
          <select class="select" name="id_recinto" required>
            <option value="">— Selecciona —</option>
            @foreach($recintos as $r)
              <option value="{{ $r->id_geografico }}" @selected(old('id_recinto')==$r->id_geografico)>
                {{ $r->nombre }} ({{ $r->codigo }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-row">
          <div class="field">
            <label class="label">Número de personas</label>
            <input class="input" type="number" min="0" name="numero_personas" value="{{ old('numero_personas', 0) }}" required>
          </div>
          <div class="field">
            <label class="label">Activa</label>
            <select class="select" name="activa" required>
              <option value="1" @selected(old('activa', '1')=='1')>Sí</option>
              <option value="0" @selected(old('activa')==='0')>No</option>
            </select>
          </div>
        </div>

        <div class="field">
          <label class="label">Descripción (opcional)</label>
          <textarea class="textarea" name="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
      </form>
    </div>
  </div>
@endsection
