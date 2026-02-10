@extends('admin.layout')

@section('title', 'Editar Geográfico')
@section('page_title', 'Editar Geográfico')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Editar</div>
        <div class="card-subtitle">{{ $item->nombre }} ({{ $item->codigo }})</div>
      </div>
      <a class="btn btn-outline" href="{{ route('admin.geografico.index') }}">Volver</a>
    </div>

    <div class="card-body">
      <form class="form" method="POST" action="{{ route('admin.geografico.update', $item->id_geografico) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
          <div class="field">
            <label class="label">Nombre</label>
            <input class="input" name="nombre" value="{{ old('nombre', $item->nombre) }}" required>
          </div>

          <div class="field">
            <label class="label">Código</label>
            <input class="input" name="codigo" value="{{ old('codigo', $item->codigo) }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label class="label">Tipo</label>
            <select class="select" name="tipo" required>
              @foreach(['PAIS','CIUDAD','MUNICIPIO','LOCALIDAD','RECINTO'] as $t)
                <option value="{{ $t }}" @selected(old('tipo',$item->tipo)===$t)>{{ $t }}</option>
              @endforeach
            </select>
          </div>

          <div class="field">
            <label class="label">Ubicación</label>
            <input class="input" name="ubicacion" value="{{ old('ubicacion', $item->ubicacion) }}">
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
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
      </form>
    </div>
  </div>
@endsection
