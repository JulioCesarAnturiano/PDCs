@extends('admin.layout')

@section('title', 'Editar Tipo Elección')
@section('page_title', 'Tipo Elección / Editar')

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Editar Tipo Elección</h1>
      <p class="page-sub">{{ $item->nombre }}</p>
    </div>

    <div class="actions">
      <a class="btn btn-outline btn-sm" href="{{ route('admin.tipo_eleccion.index') }}">
        <i class="fas fa-arrow-left"></i> Volver
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Datos</h3>
        <div class="card-sub">Actualiza nombre y código</div>
      </div>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.tipo_eleccion.actualizar', $item->id_tipo_eleccion) }}">
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
