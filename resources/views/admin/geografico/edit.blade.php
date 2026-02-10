@extends('admin.layout')

@section('title', 'Editar Geográfico')
@section('page_title', 'Editar Geográfico')

@push('styles')
<style>
  /* Extras mínimos para select con tu estilo */
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
</style>
@endpush

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Editar Geográfico</h1>
      <p class="page-sub">{{ $item->nombre }} ({{ $item->codigo }})</p>
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
        <h3 class="card-title">Editar</h3>
        <div class="card-sub">Actualiza la información del registro</div>
      </div>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.geografico.actualizar', $item->id_geografico) }}">
        @csrf
        @method('PUT')

        <div class="form-grid">
          <div class="field">
            <label class="label">Nombre <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-font"></i>
              <input class="input" name="nombre" value="{{ old('nombre', $item->nombre) }}" required>
            </div>
            @error('nombre')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Código <span class="req">*</span></label>
            <div class="control">
              <i class="fas fa-hashtag"></i>
              <input class="input" name="codigo" value="{{ old('codigo', $item->codigo) }}" required>
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
                <option value="{{ $t }}" @selected(old('tipo',$item->tipo)===$t)>{{ $t }}</option>
              @endforeach
            </select>
            @error('tipo')
              <p class="error">{{ $message }}</p>
            @enderror
          </div>

          <div class="field">
            <label class="label">Ubicación</label>
            <div class="control">
              <i class="fas fa-map-marker-alt"></i>
              <input class="input" name="ubicacion" value="{{ old('ubicacion', $item->ubicacion) }}">
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
              <option value="{{ $p->id_geografico }}" @selected(old('fk_id_geografico',$item->fk_id_geografico)==$p->id_geografico)>
                [{{ $p->tipo }}] {{ $p->nombre }} ({{ $p->codigo }})
              </option>
            @endforeach
          </select>
          @error('fk_id_geografico')
            <p class="error">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-actions">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-save"></i> Actualizar
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
