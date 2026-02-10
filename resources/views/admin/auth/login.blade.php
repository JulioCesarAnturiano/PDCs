<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ingreso al Sistema</title>

  {{-- CSS General --}}
  <link rel="stylesheet" href="{{ asset('css/cssgeneral.css') }}">

 <style>
  /* ===== FONDO GENERAL (NEGRO ABAJO -> ROJO ARRIBA) ===== */
  html, body{
    height:100%;
  }
  body{
    margin:0;
    min-height:100vh;
    background: linear-gradient(
      135deg,
      #ff0008 0%,
      #7a0005 25%,
      #2a0002 55%,
      #0b0f19 100%
    ) !important;
  }

  /* ===== LOGIN SPLIT ===== */
  .login-split{
    display:grid;
    grid-template-columns: 1.2fr 1fr;
    min-height:100vh;
  }

  /* ===== LADO IZQUIERDO (IMAGEN + ROJO ABAJO → TRANSPARENTE ARRIBA) ===== */
  .login-cover{
    position:relative;
    background: url('{{ asset('partido.jpg') }}') center center / cover no-repeat;
    overflow:hidden;
  }

  .login-cover::before{
    content:'';
    position:absolute;
    inset:0;
    background: linear-gradient(
      0deg,
      rgba(255, 0, 8, 0.85) 0%,
      rgba(252, 46, 46, 0.55) 30%,
      rgba(255, 0, 8, 0.22) 60%,
      rgba(255, 0, 8, 0.00) 100%
    );
    pointer-events:none;
  }

  .login-cover::after{
    content:'';
    position:absolute;
    inset:0;
    background: radial-gradient(
      circle at 40% 65%,
      rgba(0,0,0,0) 0%,
      rgba(0,0,0,.25) 70%,
      rgba(0,0,0,.45) 100%
    );
    pointer-events:none;
  }

  /* ===== PANEL DERECHO ===== */
  .login-panel{
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    background: transparent;
  }

  /* ===== TARJETA LOGIN ===== */
  .auth-card{
    width:100%;
    max-width:420px;
    background:#fff;
    border-radius:16px;
    overflow:hidden;
    box-shadow:
      0 25px 60px rgba(0,0,0,.25),
      0 5px 15px rgba(0,0,0,.12);
    border:1px solid rgba(0,0,0,.06);
  }

  .auth-header{
    text-align:center;
    padding:28px 24px 12px;
    border-bottom:1px solid rgba(0,0,0,.06);
  }

  .auth-logo img{
    height:70px;
    width:auto;
    display:block;
    margin:0 auto 12px;
  }

  .auth-title{
    font-size:22px;
    font-weight:900;
  }

  .auth-subtitle{
    font-size:14px;
    color:var(--muted);
    margin-top:4px;
  }

  .auth-body{
    padding:24px;
  }

  .auth-links{
    margin-top:12px;
  }

  .auth-footer{
    text-align:center;
    margin-top:14px;
    font-size:13px;
    color:var(--muted);
    font-weight:700;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 900px){
    .login-split{
      grid-template-columns: 1fr;
    }
    .login-cover{
      display:none;
    }
    .login-panel{
      padding:16px;
    }
  }
</style>

</head>

<body>

<div class="login-split">

  {{-- LADO IZQUIERDO --}}
  <div class="login-cover"></div>

  {{-- LADO DERECHO --}}
  <div class="login-panel">
    <div class="auth-card">

      {{-- HEADER --}}
      <div class="auth-header">
        <div class="auth-logo">
          <img src="{{ asset('logo.jpg') }}" alt="Logo">
        </div>
        <div class="auth-title">Sistema de Votos</div>
        <div class="auth-subtitle">Ingreso al sistema</div>
      </div>

      {{-- BODY --}}
      <div class="auth-body">

        {{-- ERROR DE SESIÓN --}}
        @if (session('error'))
          <div class="alert alert-error">
            <div class="alert__title">
              <i class="fas fa-triangle-exclamation"></i> Error
            </div>
            <div class="alert__text">{{ session('error') }}</div>
          </div>
        @endif

        {{-- ERRORES DE VALIDACIÓN --}}
        @if ($errors->any())
          <div class="alert alert-error">
            <div class="alert__title">
              <i class="fas fa-circle-exclamation"></i> Revisa los campos
            </div>
            <ul class="alert__list">
              @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- FORM --}}
        <form class="form" method="POST" action="{{ route('login.submit') }}">
          @csrf

          <div class="field">
            <label class="label">Usuario</label>
            <div class="control">
              <i class="fas fa-user"></i>
              <input
                class="input"
                type="text"
                name="nombre_usuario"
                value="{{ old('nombre_usuario') }}"
                required
                autofocus
              >
            </div>
          </div>

          <div class="field">
            <label class="label">Contraseña</label>
            <div class="control">
              <i class="fas fa-lock"></i>
              <input
                class="input"
                type="password"
                name="contrasena"
                required
              >
            </div>
          </div>

          <button class="btn btn-primary btn-block" type="submit">
            <i class="fas fa-right-to-bracket"></i> Ingresar
          </button>

          <div class="auth-links">
            <a href="{{ route('resultado.publico') }}" class="btn btn-outline btn-block">
              <i class="fas fa-chart-column"></i> Ver resultados públicos
            </a>
          </div>
        </form>

        <div class="auth-footer">
          © {{ date('Y') }} Sistema Electoral
        </div>

      </div>
    </div>
  </div>

</div>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>
</html>
