@extends('admin.layout')

@section('title', 'Mesas')
@section('page_title', 'Mesas')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Listado de Mesas</div>
        <div class="card-subtitle">Control y administración</div>
      </div>
      <a class="btn btn-primary" href="{{ route('admin.mesas.create') }}">Nueva</a>
    </div>

    <div class="card-body">
      <div class="table-wrap">
        <table class="table">
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
                  <div class="actions" style="justify-content:flex-end;">
                    <a class="btn btn-sm btn-outline" href="{{ route('admin.mesas.edit', $m->id_mesa) }}">Editar</a>
                    <form method="POST" action="{{ route('admin.mesas.destroy', $m->id_mesa) }}"
                          onsubmit="return confirm('¿Eliminar mesa?');">
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
