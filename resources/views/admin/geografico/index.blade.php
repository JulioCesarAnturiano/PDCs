@extends('admin.layout')

@section('title', 'Geográfico')
@section('page_title', 'Geográfico')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Listado Geográfico</div>
        <div class="card-subtitle">País / Ciudad / Municipio / Localidad / Recinto</div>
      </div>
      <a class="btn btn-primary" href="{{ route('admin.geografico.create') }}">Nuevo</a>
    </div>

    <div class="card-body">
      <div class="table-wrap">
        <table class="table">
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
                <td>{{ $g->nombre }}</td>
                <td>{{ $g->codigo }}</td>
                <td>
                  <span class="badge badge-info">{{ $g->tipo }}</span>
                </td>
                <td>{{ $g->ubicacion ?? '-' }}</td>
                <td>{{ $g->fk_id_geografico ?? '-' }}</td>
                <td class="text-right">
                  <div class="actions" style="justify-content:flex-end;">
                    <a class="btn btn-sm btn-outline" href="{{ route('admin.geografico.edit', $g->id_geografico) }}">Editar</a>
                    <form method="POST" action="{{ route('admin.geografico.destroy', $g->id_geografico) }}"
                          onsubmit="return confirm('¿Eliminar registro?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="7" class="text-muted">Sin registros.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
