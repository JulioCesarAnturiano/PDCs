@extends('admin.layout')

@section('title', 'Tipo Elección')
@section('page_title', 'Tipo Elección')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Tipo Elección</div>
        <div class="card-subtitle">Administración</div>
      </div>
      <a class="btn btn-primary" href="{{ route('admin.tipo_eleccion.create') }}">Nuevo</a>
    </div>

    <div class="card-body">
      <div class="table-wrap overflow-auto">
        <table class="table">
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
                <td class="font-semibold">{{ $t->nombre }}</td>
                <td><span class="badge">{{ $t->codigo }}</span></td>
                <td class="text-right whitespace-nowrap">
                  <a class="btn btn-outline" href="{{ route('admin.tipo_eleccion.edit', $t->id_tipo_eleccion) }}">Editar</a>
                  <form class="inline" method="POST" action="{{ route('admin.tipo_eleccion.destroy', $t->id_tipo_eleccion) }}"
                        onsubmit="return confirm('¿Eliminar tipo de elección?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline" type="submit">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-slate-500">No hay registros.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        {{ $tipoElecciones->links() }}
      </div>
    </div>
  </div>
@endsection
