<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/cssgeneral.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')
</head>
<body class="admin-body">

    {{-- Botón mobile --}}
    <button class="admin-mobile-toggle" type="button" id="adminMobileToggle" aria-label="Abrir menú">
        <i class="fas fa-bars"></i>
    </button>

    <div class="admin-shell">

        {{-- SIDEBAR --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-brand">
                <div class="admin-brand__mark">A</div>
                <div>
                    <div class="admin-brand__title">ADMIN</div>
                    <div class="admin-brand__sub">Panel de control</div>
                </div>
            </div>

            <nav class="admin-nav">
                <a class="navlink {{ request()->routeIs('admin.dashboard') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.votos.index') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.votos.index') }}">
                    <i class="fas fa-poll"></i>
                    <span>Votos</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.votos.registrar') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.votos.registrar') }}">
                    <i class="fas fa-plus"></i>
                    <span>Registrar voto</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.usuarios.*') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.usuarios.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.roles.*') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.roles.index') }}">
                    <i class="fas fa-user-tag"></i>
                    <span>Roles</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.tipo_eleccion.*') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.tipo_eleccion.index') }}">
                    <i class="fas fa-vote-yea"></i>
                    <span>Tipo Elección</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.geografico.*') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.geografico.index') }}">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Geográfico</span>
                </a>

                <a class="navlink {{ request()->routeIs('admin.mesas.*') ? 'navlink-active' : '' }}"
                   href="{{ route('admin.mesas.index') }}">
                    <i class="fas fa-table"></i>
                    <span>Mesas</span>
                </a>
            </nav>

            <div class="admin-sidebar__footer">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-block">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Salir</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN --}}
        <main class="admin-main">

            {{-- TOPBAR --}}
            <header class="admin-topbar">
                <div class="admin-topbar__inner">
                    <div>
                        <div class="admin-breadcrumb">@yield('page_title', 'Panel')</div>
                        <div class="admin-date">
                            <i class="far fa-calendar"></i>
                            <span>{{ now()->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="admin-user">
                        <i class="fas fa-user-circle"></i>
                        <span class="admin-user__name">{{ auth()->user()->nombre_usuario ?? auth()->user()->name }}</span>
                    </div>
                </div>
            </header>

            {{-- CONTENT --}}
            <section class="admin-content">
                @yield('content')
            </section>

        </main>

    </div>

    <script>
        (function () {
            const btn = document.getElementById('adminMobileToggle');
            const sidebar = document.getElementById('adminSidebar');

            if (!btn || !sidebar) return;

            btn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });

            // Cierra el sidebar al hacer click fuera (solo en móvil)
            document.addEventListener('click', (e) => {
                const isMobile = window.matchMedia('(max-width: 900px)').matches;
                if (!isMobile) return;

                const clickedInsideSidebar = sidebar.contains(e.target);
                const clickedToggle = btn.contains(e.target);

                if (!clickedInsideSidebar && !clickedToggle) {
                    sidebar.classList.remove('active');
                }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
