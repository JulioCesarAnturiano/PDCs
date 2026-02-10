@extends('admin.layout')

@section('title', 'Votos')
@section('page_title', 'Votos')

@push('styles')
<style>
  /* Variante INFO (tu CSS trae success/error, agregamos info) */
  .alert-info{ border-left:4px solid var(--info); }
  .alert-info .alert__title i{ color: var(--info); }
</style>
@endpush

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h2 class="page-title">Votos</h2>
      <p class="page-sub">Listado / administración</p>
    </div>

    <div class="actions">
      <a class="btn btn-primary btn-sm" href="{{ route('admin.votos.registrar') }}">
        <i class="fas fa-plus"></i> Registrar
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Listado</h3>
        <div class="card-sub">Registros disponibles</div>
      </div>
    </div>

    <div class="card-body">
      @if(empty($items))
        <div class="alert alert-info">
          <div class="alert__title">
            <i class="fas fa-info-circle"></i>
            Info
          </div>
          <div class="alert__text">
            Aún no hay módulo de tabla de votos conectado. Esta vista queda lista para enlazar.
          </div>
        </div>
      @else
        <div class="table-wrap">
          <table class="table table-admin">
            <thead>
              <tr>
                <th>ID</th>
                <th>Mesa</th>
                <th>Tipo Elección</th>
                <th>Creado</th>
                <th class="text-right">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $v)
                <tr>
                  <td>{{ $v->id ?? '-' }}</td>
                  <td>{{ $v->mesa->codigo ?? '-' }}</td>
                  <td>{{ $v->tipoEleccion->nombre ?? '-' }}</td>
                  <td>{{ $v->created_at ?? '-' }}</td>
                  <td class="text-right">—</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

</div>
@endsection
