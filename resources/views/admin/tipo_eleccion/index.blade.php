@extends('admin.layout')

@section('title', 'Tipo Elección')
@section('page_title', 'Tipo Elección')

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Tipo Elección</h1>
      <p class="page-sub">Administración</p>
    </div>

    <div class="actions">
      <a class="btn btn-primary btn-sm" href="{{ route('admin.tipo_eleccion.crear') }}">
        <i class="fas fa-plus"></i> Nuevo
      </a>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Listado</h3>
        <div class="card-sub">Tipos de elección registrados</div>
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
              <th class="text-right">Acciones</th>
            </tr>
          </thead>

          <tbody>
            @forelse($tipoElecciones as $t)
              <tr>
                <td>{{ $t->id_tipo_eleccion }}</td>
                <td>
                  <div class="cell">
                    <span class="cell-title">{{ $t->nombre }}</span>
                  </div>
                </td>
                <td><span class="badge">{{ $t->codigo }}</span></td>

                <td class="text-right">
                  <div class="actions">
                    <a class="btn btn-outline btn-sm"
                       href="{{ route('admin.tipo_eleccion.editar', $t->id_tipo_eleccion) }}">
                      <i class="fas fa-edit"></i> Editar
                    </a>

                    <form class="inline" method="POST"
                          action="{{ route('admin.tipo_eleccion.eliminar', $t->id_tipo_eleccion) }}"
                          onsubmit="return confirm('¿Eliminar tipo de elección?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline btn-sm btn-danger-outline" type="submit">
                        <i class="fas fa-trash"></i> Eliminar
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="empty">
                  <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <div>
                      <div class="empty-title">No hay registros</div>
                      <div class="empty-sub">Crea el primer tipo de elección para empezar.</div>
                    </div>
                    <a href="{{ route('admin.tipo_eleccion.crear') }}" class="btn btn-primary btn-sm">
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

    @if(method_exists($tipoElecciones, 'hasPages') && $tipoElecciones->hasPages())
      <div class="card-foot">
        {{ $tipoElecciones->links('vendor.pagination.custom') }}
      </div>
    @endif
  </div>

</div>
@endsection
