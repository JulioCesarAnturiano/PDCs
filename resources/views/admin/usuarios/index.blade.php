@extends('admin.layout')

@section('title', 'Usuarios')
@section('page_title', 'Usuarios')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Usuarios</div>
        <div class="card-subtitle">Administración</div>
      </div>
      <a class="btn btn-primary" href="{{ route('admin.usuarios.create') }}">Nuevo</a>
    </div>

    <div class="card-body">
      <div class="table-wrap overflow-auto">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Fecha fin</th>
              <th>Roles</th>
              <th class="text-right">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse($usuarios as $u)
              <tr>
                <td>{{ $u->id_usuario }}</td>
                <td class="font-semibold">{{ $u->nombre_usuario }}</td>
                <td>{{ $u->fecha_fin ? \Carbon\Carbon::parse($u->fecha_fin)->format('d/m/Y') : '—' }}</td>
                <td class="space-x-1">
                  @foreach($u->getRoleNames() as $r)
                    <span class="badge">{{ $r }}</span>
                  @endforeach
                </td>
                <td class="text-right whitespace-nowrap">
                  <a class="btn btn-outline" href="{{ route('admin.usuarios.edit', $u->id_usuario) }}">Editar</a>

                  <form class="inline" method="POST" action="{{ route('admin.usuarios.destroy', $u->id_usuario) }}"
                        onsubmit="return confirm('¿Eliminar usuario?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline" type="submit">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-slate-500">No hay usuarios.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        {{ $usuarios->links() }}
      </div>
    </div>
  </div>
@endsection
