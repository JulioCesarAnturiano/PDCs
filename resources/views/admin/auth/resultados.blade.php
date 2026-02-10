<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Resultados</title>
  <link rel="stylesheet" href="{{ asset('css/cssgeneral.css') }}">
</head>
<body>

<div class="content" style="max-width:1100px;margin:0 auto;">
  <div class="card mt-16">
    <div class="card-header">
      <div>
        <div class="card-title">Resultados Públicos</div>
        <div class="card-subtitle">Vista de consulta</div>
      </div>
      <div class="flex items-center gap-12">
        <img src="{{ asset('logo.jpg') }}" alt="Logo" style="height:34px;border-radius:10px;">
        <img src="{{ asset('partido.jpg') }}" alt="Partido" style="height:34px;border-radius:10px;">
        <a class="btn btn-outline btn-sm" href="{{ route('login') }}">Ingresar</a>
      </div>
    </div>

    <div class="card-body">
      {{-- Placeholder: aquí luego se pinta data real --}}
      <div class="grid grid-cols-3 gap-lg">
        <div class="card">
          <div class="card-body">
            <div class="kpi">
              <div>
                <div class="value">{{ $totalMesas ?? '—' }}</div>
                <div class="label">Mesas Totales</div>
              </div>
              <div class="chip">General</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="kpi">
              <div>
                <div class="value">{{ $mesasProcesadas ?? '—' }}</div>
                <div class="label">Procesadas</div>
              </div>
              <div class="chip">Actas</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="kpi">
              <div>
                <div class="value">{{ $avance ?? '—' }}</div>
                <div class="label">Avance</div>
              </div>
              <div class="chip">%</div>
            </div>
          </div>
        </div>
      </div>

      <div class="hr"></div>

      <div class="card">
        <div class="card-header">
          <div>
            <div class="card-title">Detalle</div>
            <div class="card-subtitle">Lista (placeholder)</div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-wrap">
            <table class="table" style="min-width: 600px;">
              <thead>
                <tr>
                  <th>Candidato / Opción</th>
                  <th>Votos</th>
                  <th>Porcentaje</th>
                </tr>
              </thead>
              <tbody>
                @forelse(($resultados ?? []) as $r)
                  <tr>
                    <td>{{ $r['nombre'] ?? '-' }}</td>
                    <td>{{ $r['votos'] ?? 0 }}</td>
                    <td>{{ $r['pct'] ?? '0%' }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-muted">Aún no hay datos configurados para mostrar.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
