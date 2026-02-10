@extends('admin.layout')

@section('title', 'Nueva Mesa')
@section('page_title', 'Nueva Mesa')



@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Crear Mesa</h1>
      <p class="page-sub">Asociar a un recinto</p>
    </div>

    <div class="actions">
      <a class="btn btn-outline btn-sm" href="{{ route('admin.mesas.index') }}">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Datos</h3>
        <div class="card-sub">Completa la información de la mesa</div>
      </div>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.mesas.guardar') }}">
        @csrf

        <div class="form-grid">
          <div class="field">
            <label class="label">Código (único) <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-hashtag"></i>
              <input class="input" name="codigo" value="{{ old('codigo') }}" required>
            </div>
            @error('codigo')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Nombre (opcional)</label>
            <div class="control">
              <i class="fas fa-font"></i>
              <input class="input" name="nombre" value="{{ old('nombre') }}">
            </div>
            @error('nombre')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="field">
          <label class="label">Recinto <span class="req">*</span></label>
          <select class="select" name="id_recinto" required>
            <option value="">— Selecciona —</option>
            @foreach($recintos as $r)
              <option value="{{ $r->id_geografico }}" @selected(old('id_recinto')==$r->id_geografico)>
                {{ $r->nombre }} ({{ $r->codigo }})
              </option>
            @endforeach
          </select>
          @error('id_recinto')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-grid">
          <div class="field">
            <label class="label">Número de personas <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-users"></i>
              <input class="input" type="number" min="0" name="numero_personas" value="{{ old('numero_personas', 0) }}" required>
            </div>
            @error('numero_personas')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Activa <span class="req">*</span></label>
            <select class="select" name="activa" required>
              <option value="1" @selected(old('activa', '1')=='1')>Sí</option>
              <option value="0" @selected(old('activa')==='0')>No</option>
            </select>
            @error('activa')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="field">
          <label class="label">Descripción (opcional)</label>
          <textarea class="textarea" name="descripcion" placeholder="Opcional...">{{ old('descripcion') }}</textarea>
          @error('descripcion')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-actions">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-save"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
