@extends('admin.layout')

@section('title', 'Mesas')
@section('page_title', 'Mesas')



@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Mesas</h1>
      <p class="page-sub">Control y administración</p>
    </div>

    <div class="actions">
      <a class="btn btn-primary btn-sm" href="{{ route('admin.mesas.crear') }}">
        <i class="fas fa-plus"></i> Nueva
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Listado de Mesas</h3>
        <div class="card-sub">Registros disponibles</div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-wrap">
        <table class="table table-admin">
          <thead>
            <tr>
              <th>ID</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Recinto</th>
              <th>Personas</th>
              <th>Activa</th>
              <th class="text-right">Acciones</th>
            </tr>
          </thead>

          <tbody>
            @forelse($items as $m)
              <tr>
                <td>{{ $m->id_mesa }}</td>
                <td>{{ $m->codigo }}</td>
                <td>{{ $m->nombre ?? '-' }}</td>
                <td>{{ optional($m->recinto)->nombre ?? $m->id_recinto }}</td>
                <td>{{ $m->numero_personas }}</td>
                <td>
                  @if($m->activa)
                    <span class="badge badge-success">Sí</span>
                  @else
                    <span class="badge badge-danger">No</span>
                  @endif
                </td>

                <td class="text-right">
                  <div class="actions">
                    <a class="btn btn-sm btn-outline" href="{{ route('admin.mesas.editar', $m->id_mesa) }}">
                      <i class="fas fa-edit"></i> Editar
                    </a>

                    <form class="inline" method="POST" action="{{ route('admin.mesas.eliminar', $m->id_mesa) }}"
                          onsubmit="return confirm('¿Eliminar mesa?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline btn-danger-outline" type="submit">
                        <i class="fas fa-trash"></i> Eliminar
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="empty">
                  <div class="empty-state">
                    <i class="fas fa-table"></i>
                    <div>
                      <div class="empty-title">Sin registros</div>
                      <div class="empty-sub">Crea la primera mesa para empezar.</div>
                    </div>
                    <a href="{{ route('admin.mesas.crear') }}" class="btn btn-primary btn-sm">
                      Crear mesa
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection
