@extends('admin.layout')

@section('title', 'Registrar Votos')
@section('page_title', 'Registrar Votos')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Registrar Votos</div>
        <div class="card-subtitle">Ingreso manual (prototipo)</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.votos.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.votos.store') }}">
        @csrf

        <div class="form-row">
          <div class="field">
            <label class="label">Mesa (activa)</label>
            <select class="select" name="id_mesa" required>
              <option value="">— Selecciona —</option>
              @foreach($mesasActivas as $m)
                <option value="{{ $m->id_mesa }}" @selected(old('id_mesa')==$m->id_mesa)>
                  {{ $m->codigo }} - {{ $m->nombre ?? 'Mesa' }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="field">
            <label class="label">Tipo de Elección</label>
            <select class="select" name="id_tipo_eleccion" required>
              <option value="">— Selecciona —</option>
              @foreach($tipos as $t)
                <option value="{{ $t->id_tipo_eleccion }}" @selected(old('id_tipo_eleccion')==$t->id_tipo_eleccion)>
                  {{ $t->nombre }} ({{ $t->codigo }})
                </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Placeholder de campos numéricos (ajusta cuando definan tabla votos real) --}}
        <div class="form-row">
          <div class="field">
            <label class="label">Votos válidos</label>
            <input class="input" type="number" min="0" name="votos_validos" value="{{ old('votos_validos', 0) }}" required>
          </div>
          <div class="field">
            <label class="label">Votos nulos</label>
            <input class="input" type="number" min="0" name="votos_nulos" value="{{ old('votos_nulos', 0) }}" required>
          </div>
        </div>

        <div class="field">
          <label class="label">Observación (opcional)</label>
          <textarea class="textarea" name="observacion">{{ old('observacion') }}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
      </form>
    </div>
  </div>
@endsection
