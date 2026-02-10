@extends('admin.layout')

@section('title', 'Votos')
@section('page_title', 'Votos')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Votos</div>
        <div class="card-subtitle">Listado / administración</div>
      </div>
      <a class="btn btn-primary" href="{{ route('admin.votos.registrar') }}">Registrar</a>
    </div>

    <div class="card-body">
      @if(empty($items))
        <div class="alert alert-info">
          <div>
            <div class="title">Info</div>
            <div class="text">Aún no hay módulo de tabla de votos conectado. Esta vista queda lista para enlazar.</div>
          </div>
        </div>
      @else
        <div class="table-wrap">
          <table class="table">
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
@endsection
