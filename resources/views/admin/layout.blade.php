<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Topbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold">
                    P
                </div>
                <div>
                    <p class="text-sm text-gray-500">Sistema</p>
                    <h1 class="text-lg font-semibold text-gray-800">@yield('header', 'Panel')</h1>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Salir
                </button>
            </form>
        </div>
    </header>

    <!-- Layout -->
    <div class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-12 gap-6">

        <!-- Sidebar -->
        <aside class="col-span-12 md:col-span-3 lg:col-span-2">
            <nav class="bg-white rounded-xl shadow p-3 space-y-1">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>

                @role('admin')
                <a href="{{ route('admin.usuarios.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.usuarios.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <i class="fa-solid fa-users"></i> Usuarios
                </a>

                <a href="{{ route('admin.roles.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <i class="fa-solid fa-user-shield"></i> Roles
                </a>

                <a href="{{ route('admin.geografico.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.geografico.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <i class="fa-solid fa-map-location-dot"></i> Geográfico
                </a>

                <a href="{{ route('admin.mesas.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.mesas.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <i class="fa-solid fa-table"></i> Mesas
                </a>
                @endrole

                @role('admin|transcriptor')
                <a href="{{ route('admin.votos.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.votos.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    <i class="fa-solid fa-check-to-slot"></i> Votos
                </a>
                @endrole
            </nav>
        </aside>

        <!-- Content -->
        <main class="col-span-12 md:col-span-9 lg:col-span-10">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-800 border border-red-200">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
