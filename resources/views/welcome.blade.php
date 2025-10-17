<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Tazón Criollo</title>
</head>
<body>
    <!-- Barra de navegación -->
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset(path:'storage/general/logo.png') }}" alt="Logo Tazón Criollo">
        </div>
        <nav class="menu">
            <a href="#">Rol</a>
            <a href="#">permisos</a>
            <a href="#">user</a>
            <a href="#">categoria</a>
            <a href="#">producto</a>
            <a href="#">mesa</a>
            <a href="#">pedido</a>
        </nav>
        <div class="login-btn">
            <a href="{{ route('login') }}">Acceso</a>
        </div>
    </header>

    <!-- Contenedor del contenido principal con imagen de fondo -->
    <div class="contenido-principal">
        <img src="{{ asset(path:'storage/general/fondo.png') }}" alt="Platos del Menú" class="fondo-img">
    </div>

    <!-- Pie de página -->
    <footer class="footer">
        <p>© 2025 Tazón Criollo - Todos los derechos reservados.</p>
    </footer>

    <style>
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 50px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .menu {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
            position: relative;
        }

        .menu a:hover {
            color: #b35b00;
        }

        .menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #b35b00;
            transition: width 0.3s;
        }

        .menu a:hover::after {
            width: 100%;
        }

        .login-btn a {
            text-decoration: none;
            background-color: #b35b00;
            color: #fff;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .login-btn a:hover {
            background-color: #8c4600;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(179, 91, 0, 0.3);
        }

        /* CONTENIDO PRINCIPAL */
        .contenido-principal {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px 20px;
            background-color: #f5f5f5;
        }

        .fondo-img {
            max-width: 100%;
            width: auto;
            height: auto;
            max-height: 70vh;
            object-fit: contain;
            border-radius: 8px;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #222;
            color: #fff;
            font-size: 0.9rem;
            margin-top: auto;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }

            .logo img {
                width: 50px;
                height: 50px;
            }

            .menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .menu a {
                font-size: 0.9rem;
            }

            .login-btn a {
                font-size: 0.9rem;
                padding: 8px 20px;
            }

            .contenido-principal {
                padding: 20px 10px;
            }

            .fondo-img {
                max-height: 60vh;
            }

            .footer {
                font-size: 0.8rem;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 12px 15px;
            }

            .logo img {
                width: 45px;
                height: 45px;
            }

            .menu a {
                font-size: 0.85rem;
            }

            .fondo-img {
                max-height: 50vh;
            }
        }
    </style>
</body>
</html>