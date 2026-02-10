<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Resultados</title>
  <link rel="stylesheet" href="{{ asset('css/cssgeneral.css') }}">

  <style>
    /* ===== Resultados públicos (extra mínimo) ===== */
    .public-wrap{
      max-width:1100px;
      margin:0 auto;
      padding:20px;
    }
    .public-card{ margin-top: 18px; }

    .public-top{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
    }
    .public-logos{
      display:flex;
      align-items:center;
      gap:12px;
      flex-wrap:wrap;
    }
    .public-logos img{
      height:34px;
      border-radius:10px;
      display:block;
    }

    .public-kpi-grid{
      display:grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap:12px;
    }
    .public-kpi{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:10px;
    }
    .public-kpi .val{
      font-size:26px;
      font-weight:900;
      line-height:1;
    }
    .public-kpi .lbl{
      margin-top:6px;
      font-size:12px;
      color:var(--muted);
      font-weight:900;
      text-transform:uppercase;
      letter-spacing:.5px;
    }
    .chip{
      display:inline-flex;
      align-items:center;
      padding:6px 10px;
      border-radius:999px;
      font-weight:900;
      font-size:12px;
      border:1px solid var(--line);
      background:#fff;
      color:var(--text);
      white-space:nowrap;
    }
    .chip-red{ border-color: rgba(255,0,8,.28); background: rgba(255,0,8,.10); }
    .chip-gold{ border-color: rgba(255,163,7,.30); background: rgba(255,163,7,.14); }

    @media (max-width: 900px){
      .public-kpi-grid{ grid-template-columns: 1fr; }
    }
  </style>
</head>

<body>
  <div class="public-wrap">
    <div class="card public-card">

      <div class="card-head">
        <div class="public-top">
          <div>
            <h1 class="card-title">Resultados Públicos</h1>
            <div class="card-sub">Vista de consulta</div>
          </div>

          <div class="public-logos">
            <img src="{{ asset('logo.jpg') }}" alt="Logo">
            <img src="{{ asset('partido.jpg') }}" alt="Partido">
            <a class="btn btn-outline btn-sm" href="{{ route('login') }}">
              <i class="fas fa-right-to-bracket"></i> Ingresar
            </a>
          </div>
        </div>
      </div>

      <div class="card-body">
        {{-- KPI --}}
        <div class="public-kpi-grid">
          <div class="card">
            <div class="card-body">
              <div class="public-kpi">
                <div>
                  <div class="val">{{ $totalMesas ?? '—' }}</div>
                  <div class="lbl">Mesas totales</div>
                </div>
                <div class="chip chip-gold">General</div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="public-kpi">
                <div>
                  <div class="val">{{ $mesasProcesadas ?? '—' }}</div>
                  <div class="lbl">Procesadas</div>
                </div>
                <div class="chip chip-red">Actas</div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <div class="public-kpi">
                <div>
                  <div class="val">{{ $avance ?? '—' }}</div>
                  <div class="lbl">Avance</div>
                </div>
                <div class="chip">%</div>
              </div>
            </div>
          </div>
        </div>

        <div class="hr"></div>

        {{-- Detalle --}}
        <div class="card">
          <div class="card-head">
            <div>
              <h2 class="card-title">Detalle</h2>
              <div class="card-sub">Lista (placeholder)</div>
            </div>
          </div>

          <div class="card-body">
            <div class="table-wrap">
              <table class="table table-admin" style="min-width:600px;">
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
                      <td>
                        <div class="cell">
                          <span class="cell-title">{{ $r['nombre'] ?? '-' }}</span>
                        </div>
                      </td>
                      <td>{{ $r['votos'] ?? 0 }}</td>
                      <td>{{ $r['pct'] ?? '0%' }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3" class="empty">
                        <div class="empty-state">
                          <i class="fas fa-chart-column"></i>
                          <div>
                            <div class="empty-title">Aún no hay datos</div>
                            <div class="empty-sub">No hay resultados configurados para mostrar.</div>
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
    </div>
  </div>

  {{-- FontAwesome (tu layout admin lo trae, pero esta vista es pública y no lo incluye) --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>
</html>
