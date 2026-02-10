@extends('admin.layout')

@section('title', 'Roles')
@section('page_title', 'Roles')

@section('content')
<div class="page">

  <div class="page-head">
    <div>
      <h1 class="page-title">Roles</h1>
      <p class="page-sub">Listado (Spatie)</p>
    </div>
  </div>

  <div class="card">
    <div class="card-head">
      <div>
        <h3 class="card-title">Listado</h3>
        <div class="card-sub">Roles registrados en el sistema</div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-wrap">
        <table class="table table-admin">
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
                <td>
                  <div class="cell">
                    <span class="cell-title">{{ $r->name }}</span>
                  </div>
                </td>
                <td>{{ $r->guard_name }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="empty">
                  <div class="empty-state">
                    <i class="fas fa-user-tag"></i>
                    <div>
                      <div class="empty-title">No hay roles</div>
                      <div class="empty-sub">Crea roles desde tu seed o panel (si corresponde).</div>
                    </div>
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
