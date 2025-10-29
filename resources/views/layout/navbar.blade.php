<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo', 'Tazón Criollo')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>

  <!-- Header superior con logo -->
  <header class="top-header">
    <div class="logo-container">
      <img src="{{ asset('storage/general/logo.png') }}" alt="Tazón Criollo" class="logo">
      <div class="brand-text">
        <h1>TAZÓN CRIOLLO</h1>
        <p>Sabor Auténtico Boliviano</p>
      </div>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-left">
      <div class="cart-icon">
        <img src="{{ asset('storage/general/carrito.png') }}" alt="Carrito" class="logoCarrito">
        <span class="cart-badge">3</span>
      </div>
    </div>

    <ul class="nav-center">     
      <li><a href="{{ route('mostrar.rol') }}">
        <span class="nav-icon">👥</span>
        <span>Roles</span>
      </a></li>
      <li><a href="{{ route('mostrar.usuario') }}">
        <span class="nav-icon">👤</span>
        <span>Usuarios</span>
      </a></li>
      <li><a href="{{ route('mostrar.permiso') }}">
        <span class="nav-icon">🔐</span>
        <span>Permisos</span>
      </a></li>
      <li><a href="#">
        <span class="nav-icon">💼</span>
        <span>Trabajadores</span>
      </a></li>
      <li><a href="#">
        <span class="nav-icon">📦</span>
        <span>Productos</span>
      </a></li>
      <li><a href="{{ route('mostrar.menu') }}">
        <span class="nav-icon">🍽️</span>
        <span>Menú</span>
      </a></li>
      <li><a href="{{ route('mostrar.mesa') }}">
        <span class="nav-icon">🪑</span>
        <span>Mesas</span>
      </a></li>
      <li><a href="{{ route('mostrar.pedido') }}">
        <span class="nav-icon">🧾</span>
        <span>Pedidos</span>

    </ul>

    <div class="nav-right">
      <div class="user-info">
        <span class="user-name">Admin</span>
        <div class="user-avatar">A</div>
      </div>
      <a href="{{ route('logout') }}" class="logout-btn">
        <span>Cerrar Sesión</span>
        <span class="logout-icon">→</span>
      </a>
    </div>
  </nav>

  <!-- Contenido principal -->
  <main class="main-content">
    <section class="hero">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        @yield('contenido')
      </div>
    </section>

    <!-- Sección adicional para contenido de páginas -->
    <section class="page-content">
      @yield('page-content')
    </section>
  </main>

  <!-- Footer opcional -->
  <footer class="footer">
    <p>&copy; 2025 <strong>Tazón Criollo</strong> - Todos los derechos reservados</p>
  </footer>

</body>
</html>