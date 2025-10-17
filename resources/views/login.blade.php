<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tazón Criollo</title>
    <link rel="stylesheet" href="{{ asset(path:'css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <!-- Sección izquierda decorativa -->
        <div class="left-section">
            <div class="decoration-circle circle-1"></div>
            <div class="decoration-circle circle-2"></div>
            <div class="decoration-circle circle-3"></div>
            <div class="decoration-line line-1"></div>
            <div class="decoration-line line-2"></div>
            <div class="decoration-dots"></div>
            
            <div class="welcome-content">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="{{ asset('storage/general/logo.png') }}" alt="Logo Tazón Criollo">
                    </div>
                </div>
                <h1>¡Bienvenido de nuevo!</h1>
                <p>Inicia sesión para acceder con tu cuenta existente.</p>
            </div>
            
            <div class="decoration-wave"></div>
        </div>

        <!-- Sección derecha del formulario -->
        <div class="right-section">
            <div class="form-container">
                <h2>Iniciar Sesión</h2>
                  <!-- Sección iniciar sesion  del login -->
                <form action="{{ route('sendlogin') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <input type="text" placeholder="Usuario" name="username" required>
                    </div>

                    <div class="input-group">
                        <div class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <input type="password" placeholder="Contraseña" name="password" required>
                    </div>
                   @if (session('errorUser'))
                       {{ session('errorUser') }}
                   @endif

                   @if (session('password'))
                       {{ session('password') }}
                   @endif

                    <button type="submit" class="btn-login">Iniciar Sesión</button>

                    <div class="register-link">
                        ¿Nuevo aquí? <a href="#">Crear una Cuenta</a>
                    </div>
                </form>

                <!-- FINAL Sección iniciar sesion  del login -->
            </div>
        </div>
    </div>