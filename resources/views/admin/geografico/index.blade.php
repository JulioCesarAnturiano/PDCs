@extends('admin.layout')

@section('title', 'Geográfico')
@section('page_title', 'Geográfico')

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Geográfico</h1>
      <p class="page-sub">País / Ciudad / Municipio / Localidad / Recinto</p>
    </div>

    <div class="actions">
      <a class="btn btn-primary btn-sm" href="{{ route('admin.geografico.crear') }}">
        <i class="fas fa-plus"></i> Nuevo
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Listado Geográfico</h3>
        <div class="card-sub">Registros disponibles</div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-wrap">
        <table class="table table-admin">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Código</th>
              <th>Tipo</th>
              <th>Ubicación</th>
              <th>Padre</th>
              <th class="text-right">Acciones</th>
            </tr>
          </thead>

          <tbody>
            @forelse($items as $g)
              <tr>
                <td>{{ $g->id_geografico }}</td>
                <td>
                  <div class="cell">
                    <span class="cell-title">{{ $g->nombre }}</span>
                  </div>
                </td>
                <td><span class="badge">{{ $g->codigo }}</span></td>
                <td>
                  <span class="badge badge-info">{{ $g->tipo }}</span>
                </td>
                <td>{{ $g->ubicacion ?? '-' }}</td>
                <td>{{ $g->fk_id_geografico ?? '-' }}</td>

                <td class="text-right">
                  <div class="actions">
                    <a class="btn btn-sm btn-outline" href="{{ route('admin.geografico.editar', $g->id_geografico) }}">
                      <i class="fas fa-edit"></i> Editar
                    </a>

                    <form class="inline" method="POST" action="{{ route('admin.geografico.eliminar', $g->id_geografico) }}"
                          onsubmit="return confirm('¿Eliminar registro?');">
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
                    <i class="fas fa-map-marked-alt"></i>
                    <div>
                      <div class="empty-title">Sin registros</div>
                      <div class="empty-sub">Crea el primer registro geográfico para empezar.</div>
                    </div>
                    <a href="{{ route('admin.geografico.crear') }}" class="btn btn-primary btn-sm">
                      Crear
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
