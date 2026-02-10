@extends('admin.layout')

@section('title', 'Roles')
@section('page_title', 'Roles')

@section('content')
  <div class="card">
    <div class="card-header">
      <div>
        <div class="card-title">Roles</div>
        <div class="card-subtitle">Listado (Spatie)</div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-wrap overflow-auto">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Guard</th>
            </tr>
          </thead>
          <tbody>
            @forelse($roles as $r)
              <tr>
                <td>{{ $r->id }}</td>
                <td class="font-semibold">{{ $r->name }}</td>
                <td>{{ $r->guard_name }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="text-slate-500">No hay roles.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
