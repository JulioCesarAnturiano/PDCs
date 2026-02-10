@extends('admin.layout')

@section('title', 'Registrar Votos')
@section('page_title', 'Registrar Votos')

@push('styles')
<style>
  /* Extras mínimos para que select/textarea se vean como tus inputs */
  .select,
  .textarea{
    width:100%;
    border:1px solid var(--line);
    border-radius:14px;
    padding:10px 12px;
    background:#fff;
    color:var(--text);
    font-size:14px;
    outline:none;
  }
  .select:focus,
  .textarea:focus{
    border-color: rgba(255,0,8,.35);
    box-shadow: 0 0 0 4px rgba(255,0,8,.08);
  }
  .textarea{ min-height: 110px; resize: vertical; }

  /* Si quieres que el botón quede al lado en desktop */
  .form-actions{ display:flex; gap:10px; justify-content:flex-end; }
  @media (max-width: 900px){
    .form-actions{ justify-content:flex-start; }
  }
</style>
@endpush

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h2 class="page-title">Registrar Votos</h2>
      <p class="page-sub">Ingreso manual (prototipo)</p>
    </div>

    <div class="actions">
      <a class="btn btn-outline btn-sm" href="{{ route('admin.votos.index') }}">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Formulario</h3>
        <div class="card-sub">Completa los datos y guarda el registro</div>
      </div>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.votos.guardar') }}">
        @csrf

        <div class="form-grid">
          <div class="field">
            <label class="label">Mesa (activa) <span class="req">*</span></label>
            <select class="select" name="id_mesa" required>
              <option value="">— Selecciona —</option>
              @foreach($mesasActivas as $m)
                <option value="{{ $m->id_mesa }}" @selected(old('id_mesa')==$m->id_mesa)>
                  {{ $m->codigo }} - {{ $m->nombre ?? 'Mesa' }}
                </option>
              @endforeach
            </select>
            @error('id_mesa')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Tipo de Elección <span class="req">*</span></label>
            <select class="select" name="id_tipo_eleccion" required>
              <option value="">— Selecciona —</option>
              @foreach($tipos as $t)
                <option value="{{ $t->id_tipo_eleccion }}" @selected(old('id_tipo_eleccion')==$t->id_tipo_eleccion)>
                  {{ $t->nombre }} ({{ $t->codigo }})
                </option>
              @endforeach
            </select>
            @error('id_tipo_eleccion')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="form-grid">
          <div class="field">
            <label class="label">Votos válidos <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-check-circle"></i>
              <input class="input" type="number" min="0" name="votos_validos" value="{{ old('votos_validos', 0) }}" required>
            </div>
            @error('votos_validos')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Votos nulos <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-times-circle"></i>
              <input class="input" type="number" min="0" name="votos_nulos" value="{{ old('votos_nulos', 0) }}" required>
            </div>
            @error('votos_nulos')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="field">
          <label class="label">Observación (opcional)</label>
          <textarea class="textarea" name="observacion" placeholder="Escribe una observación...">{{ old('observacion') }}</textarea>
          @error('observacion')
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
