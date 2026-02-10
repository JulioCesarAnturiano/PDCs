<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ingreso</title>
  <link rel="stylesheet" href="{{ asset('css/cssgeneral.css') }}">
</head>
<body>

<div class="auth-shell">
  <div class="auth-card">

    <div class="auth-header">
      <div class="flex items-center gap-12">
        <div class="brand-badge" style="width:44px;height:44px;overflow:hidden;border-radius:14px;">
          <img src="{{ asset('logo.jpg') }}" alt="Logo" style="width:100%;height:100%;object-fit:cover;">
        </div>
        <div>
          <div class="auth-title">Sistema de Votos</div>
          <div class="auth-subtitle">Ingresa con tu usuario</div>
        </div>
      </div>
    </div>

    <div class="auth-body">
      @if (session('error'))
        <div class="alert alert-danger">
          <div>
            <div class="title">Error</div>
            <div class="text">{{ session('error') }}</div>
          </div>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <div>
            <div class="title">Revisa los campos</div>
            <div class="text">
              <ul class="m-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endif

      <form class="form" method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="field">
          <label class="label">Usuario</label>
          <input class="input" type="text" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required autocomplete="username">
        </div>

        <div class="field">
          <label class="label">Contraseña</label>
          <input class="input" type="password" name="contrasena" required autocomplete="current-password">
        </div>

        <button class="btn btn-primary w-full" type="submit">Ingresar</button>

        <div class="text-center text-muted mt-12">
          <a href="{{ route('resultado.publico') }}">Ver resultados públicos</a>
        </div>
      </form>

      <div class="hr"></div>

      <div class="flex items-center justify-between">
        <div class="text-muted" style="font-size:12px;">
          © {{ date('Y') }} Sistema
        </div>
        <img src="{{ asset('partido.jpg') }}" alt="Partido" style="height:26px;width:auto;border-radius:8px;opacity:.9;">
      </div>
    </div>

  </div>
</div>

</body>
</html>
