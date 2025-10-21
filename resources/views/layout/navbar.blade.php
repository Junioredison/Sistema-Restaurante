<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>

  <!-- Header superior con logo -->
  <header class="top-header">
    <img src="{{ asset('storage/general/logo.png') }}" alt="Tazón Criollo" class="logo">
  </header>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="cart-icon">
      <img src="{{ asset('storage/general/carrito.png') }}" alt="Carrito" class="logoCarrito">
    </div>

    <ul class="nav-ini">     
      <li><a href="{{ route('mostrar.rol') }}">Roles</a></li>
      <li><a href="#">Usuarios</a></li>
      <li><a href="{{ route('mostrar.permiso') }}">Permisos</a></li>
      <li><a href="#">Trabajadores</a></li>
      <li><a href="#">Productos</a></li>
      <li><a href="#">Menú</a></li>
    </ul>

    <ul class="nav-fin">    
      <li><a href="{{ route('logout') }}" class="logout-btn">Logout</a></li>
    </ul>
  </nav>

  <section class="hero">
    <div class="hero-content">
      @yield('contenido')
    </div>
  </section>

</body>
</html>
