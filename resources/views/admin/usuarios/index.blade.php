@extends('admin.layout')

@section('title', 'Usuarios')
@section('page_title', 'Usuarios')

@section('content')
  <div class="page">
    {{-- Header --}}
    <div class="page-head">
      <div>
        <h1 class="page-title">Usuarios</h1>
        <p class="page-sub">Administración de usuarios del sistema</p>
      </div>

      <a class="btn btn-primary" href="{{ route('admin.usuarios.crear') }}">
        <i class="fas fa-plus"></i>
        Nuevo Usuario
      </a>
    </div>

    {{-- Card --}}
    <div class="card">
      {{-- Toolbar --}}
      <div class="card-head">
        <div class="search">
          <i class="fas fa-search"></i>
          <input id="searchInput" class="search-input" type="text" placeholder="Buscar usuario..." onkeyup="filterTable()">
        </div>

        <div class="actions">
          <button class="btn btn-outline btn-sm" type="button" onclick="resetFilters()">
            <i class="fas fa-redo"></i>
            Limpiar
          </button>
        </div>
      </div>

      {{-- Table --}}
      <div class="table-wrap">
        <table class="table table-admin" id="usersTable">
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
              @php
                $expired = $u->fecha_fin && \Carbon\Carbon::parse($u->fecha_fin)->lt(now());
              @endphp

              <tr class="{{ $expired ? 'row-expired' : '' }}">
                <td>{{ $u->id_usuario }}</td>

                <td>
                  <div class="cell">
                    <span class="cell-title">{{ $u->nombre_usuario }}</span>
                    @if($expired)
                      <span class="pill pill-danger">Expirado</span>
                    @endif
                  </div>
                </td>

                <td>
                  {{ $u->fecha_fin ? \Carbon\Carbon::parse($u->fecha_fin)->format('d/m/Y') : '—' }}
                </td>

                <td>
                  <div class="badges">
                    @foreach($u->getRoleNames() as $r)
                      <span class="badge badge-{{ getBadgeColor($r) }}">{{ $r }}</span>
                    @endforeach
                  </div>
                </td>

                <td class="text-right">
                  <div class="actions">
                    <a class="btn btn-outline btn-sm" href="{{ route('admin.usuarios.editar', $u->id_usuario) }}">
                      <i class="fas fa-edit"></i>
                      Editar
                    </a>

                    <form class="inline" method="POST" action="{{ route('admin.usuarios.eliminar', $u->id_usuario) }}"
                          onsubmit="return confirmDelete()">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline btn-sm btn-danger-outline" type="submit">
                        <i class="fas fa-trash"></i>
                        Eliminar
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="empty">
                  <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <div>
                      <div class="empty-title">No hay usuarios registrados</div>
                      <div class="empty-sub">Crea el primero para empezar.</div>
                    </div>
                    <a href="{{ route('admin.usuarios.crear') }}" class="btn btn-primary btn-sm">
                      Crear primer usuario
                    </a>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Pagination --}}
      @if($usuarios->hasPages())
        <div class="card-foot">
          {{ $usuarios->links('vendor.pagination.custom') }}
        </div>
      @endif
    </div>
  </div>

  @php
    function getBadgeColor($role) {
      $colors = [
        'admin' => 'primary',
        'administrator' => 'primary',
        'superadmin' => 'primary',
        'transcriptor' => 'secondary',
        'validator' => 'success',
        'auditor' => 'warning',
        'user' => 'neutral',
        'viewer' => 'info'
      ];

      $roleLower = strtolower($role);
      foreach ($colors as $key => $color) {
        if (str_contains($roleLower, $key)) return $color;
      }
      return 'neutral';
    }
  @endphp
@endsection

@push('scripts')
<script>
  function filterTable() {
    const input = document.getElementById('searchInput');
    const filter = (input.value || '').toUpperCase();
    const table = document.getElementById('usersTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
      const row = rows[i];
      const cells = row.getElementsByTagName('td');
      let found = false;

      for (let j = 0; j < cells.length; j++) {
        const txtValue = (cells[j].textContent || cells[j].innerText || '').toUpperCase();
        if (txtValue.indexOf(filter) > -1) { found = true; break; }
      }

      row.style.display = found ? '' : 'none';
    }
  }

  function resetFilters() {
    document.getElementById('searchInput').value = '';
    filterTable();
  }

  function confirmDelete() {
    return confirm('¿Está seguro de eliminar este usuario? Esta acción no se puede deshacer.');
  }
</script>
@endpush
