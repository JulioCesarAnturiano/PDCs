@extends('admin.layout')

@section('title', 'Nuevo Geográfico')
@section('page_title', 'Nuevo Geográfico')

@push('styles')
<style>
  /* Extras mínimos para select y helper con tu estilo */
  .select{
    width:100%;
    border:1px solid var(--line);
    border-radius:14px;
    padding:10px 12px;
    background:#fff;
    color:var(--text);
    font-size:14px;
    outline:none;
  }
  .select:focus{
    border-color: rgba(255,0,8,.35);
    box-shadow: 0 0 0 4px rgba(255,0,8,.08);
  }

  .help{
    margin-top:6px;
    font-size:13px;
    color:var(--muted);
    display:flex;
    align-items:center;
    gap:8px;
  }
  .help::before{
    content:"\f05a"; /* fa-info-circle */
    font-family:"Font Awesome 6 Free";
    font-weight:900;
    color: var(--gold);
  }
</style>
@endpush

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Nuevo Geográfico</h1>
      <p class="page-sub">Registrar ubicación</p>
    </div>

    <div class="actions">
      <a class="btn btn-outline btn-sm" href="{{ route('admin.geografico.index') }}">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Crear</h3>
        <div class="card-sub">Complete los datos del registro</div>
      </div>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.geografico.guardar') }}">
        @csrf

        <div class="form-grid">
          <div class="field">
            <label class="label">Nombre <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-font"></i>
              <input class="input" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            @error('nombre')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

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
        </div>

        <div class="form-grid">
          <div class="field">
            <label class="label">Tipo <span class="req">*</span></label>
            <select class="select" name="tipo" required>
              @foreach(['PAIS','CIUDAD','MUNICIPIO','LOCALIDAD','RECINTO'] as $t)
                <option value="{{ $t }}" @selected(old('tipo')===$t)>{{ $t }}</option>
              @endforeach
            </select>
            @error('tipo')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Ubicación (opcional)</label>
            <div class="control">
              <i class="fas fa-map-marker-alt"></i>
              <input class="input" name="ubicacion" value="{{ old('ubicacion') }}">
            </div>
            @error('ubicacion')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="field">
          <label class="label">Padre (opcional)</label>
          <select class="select" name="fk_id_geografico">
            <option value="">— Ninguno —</option>
            @foreach($padres as $p)
              <option value="{{ $p->id_geografico }}" @selected(old('fk_id_geografico')==$p->id_geografico)>
                [{{ $p->tipo }}] {{ $p->nombre }} ({{ $p->codigo }})
              </option>
            @endforeach
          </select>

          <div class="help">Útil para anidar (ej. RECINTO dentro de LOCALIDAD).</div>

          @error('fk_id_geografico')
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
