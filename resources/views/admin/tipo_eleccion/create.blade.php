@extends('admin.layout')

@section('title', 'Crear Tipo Elección')
@section('page_title', 'Tipo Elección / Crear')

@section('content')
  <div class="page">
    <div class="page-head">
      <div>
        <h1 class="page-title">Crear Tipo Elección</h1>
        <p class="page-sub">Nuevo registro</p>
      </div>

      <a class="btn btn-outline btn-sm" href="{{ route('admin.tipo_eleccion.index') }}">
        <i class="fas fa-arrow-left"></i>
        Volver
      </a>
    </div>

    <div class="card">
      <div class="card-head">
        <div>
          <h2 class="card-title">Datos</h2>
          <p class="card-sub">Complete la información del tipo de elección</p>
        </div>
      </div>

      <div class="card-body">
        <form class="form" method="POST" action="{{ route('admin.tipo_eleccion.guardar') }}">
          @csrf

          <div class="form-grid">
            <div class="field">
              <label class="label">Nombre <span class="req">*</span></label>
              <div class="control">
                <i class="fas fa-font"></i>
                <input
                  class="input"
                  name="nombre"
                  value="{{ old('nombre') }}"
                  required
                >
              </div>
              @error('nombre')
                <p class="error">{{ $message }}</p>
              @enderror
            </div>

            <div class="field">
              <label class="label">Código <span class="req">*</span></label>
              <div class="control">
                <i class="fas fa-hashtag"></i>
                <input
                  class="input"
                  name="codigo"
                  value="{{ old('codigo') }}"
                  required
                >
              </div>
              @error('codigo')
                <p class="error">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-save"></i>
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
