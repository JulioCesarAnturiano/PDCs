@extends('admin.layout')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="dash">

    {{-- Header --}}
    <div class="dash-header">
        <div>
            <h1 class="dash-title">Dashboard</h1>
            <p class="dash-subtitle">Resumen general del sistema</p>
        </div>

        <div class="dash-actions">
            @can('admin.votos.registrar')
                <a href="{{ route('admin.votos.registrar') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Registrar voto
                </a>
            @endcan
        </div>
    </div>

    {{-- KPI GRID --}}
    <div class="kpi-grid">

        {{-- Usuarios --}}
        @can('admin.usuarios.ver')
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon-red">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="kpi-label">Usuarios</div>
                <div class="kpi-value">{{ $totalUsuarios ?? 0 }}</div>
                <div class="kpi-meta">
                    <a class="link" href="{{ route('admin.usuarios.index') }}">
                        Ver usuarios <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        {{-- Roles --}}
        @can('admin.roles.ver')
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon-gold">
                <i class="fas fa-user-tag"></i>
            </div>
            <div>
                <div class="kpi-label">Roles</div>
                <div class="kpi-value">{{ $totalRoles ?? 0 }}</div>
                <div class="kpi-meta">
                    <a class="link" href="{{ route('admin.roles.index') }}">
                        Ver roles <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        {{-- Tipos de Elección --}}
        @can('admin.tipo_eleccion.ver')
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon-red">
                <i class="fas fa-vote-yea"></i>
            </div>
            <div>
                <div class="kpi-label">Tipos de eleccion</div>
                <div class="kpi-value">{{ $totalTipoEleccion ?? 0 }}</div>
                <div class="kpi-meta">
                    <a class="link" href="{{ route('admin.tipo_eleccion.index') }}">
                        Ver tipos <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

        {{-- Geográfico --}}
        @can('admin.geografico.ver')
        <div class="kpi-card">
            <div class="kpi-icon kpi-icon-gold">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div>
                <div class="kpi-label">Geografico</div>
                <div class="kpi-value">{{ $totalGeografico ?? 0 }}</div>
                <div class="kpi-meta">
                    <a class="link" href="{{ route('admin.geografico.index') }}">
                        Ver registros <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endcan

    </div>

    {{-- Card extra: Votos --}}
    @canany(['admin.votos.ver','admin.votos.registrar'])
    <div class="card">
        <div class="card-head">
            <div>
                <h3 class="card-title"><i class="fas fa-poll"></i> Votos</h3>
                <div class="card-sub">Acciones rápidas</div>
            </div>

            <div class="dash-actions">
                @can('admin.votos.ver')
                <a href="{{ route('admin.votos.index') }}" class="btn btn-outline btn-sm">
                    <i class="fas fa-list"></i> Ver votos
                </a>
                @endcan

                @can('admin.votos.registrar')
                <a href="{{ route('admin.votos.registrar') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Registrar
                </a>
                @endcan
            </div>
        </div>

        <div class="card-body">
            <p class="dash-subtitle" style="margin:0;">
                Aquí puedes revisar el listado de votos o registrar uno nuevo según tus permisos.
            </p>
        </div>
    </div>
    @endcanany

</div>

@endsection
