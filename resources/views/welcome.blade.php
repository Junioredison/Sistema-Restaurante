<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Tazón Criollo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('storage/general/logo.png') }}" alt="Logo Tazón Criollo" class="logo-circle">
            <h1>TAZÓN CRIOLLO</h1>
        </div>
        <nav class="menu">
            <a href="#">Inicio</a>
            <a href="#">ubicación</a>
            <a href="#">Nosotros</a>
            <a href="#">Contacto</a>
        </nav>
        <div class="login-btn">
            <a href="{{ route('login') }}">Acceder</a>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <img src="{{ asset('storage/general/fondo.png') }}" alt="Fondo Tazón Criollo" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2>El sabor criollo que te hace sentir en casa</h2>
            <p>Disfruta platos tradicionales con un toque moderno. Frescos, sabrosos y 100% bolivianos.</p>
            <a href="#" class="btn-reservar">Ver Carta</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p>© 2025 <strong>Tazón Criollo</strong> — Todos los derechos reservados.</p>
    </footer>

    <style>
        /* RESET Y FUENTE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #fffaf3;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            position: sticky;
            top: 0;
            background-color: #b16708;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-circle {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
        }

        .logo h1 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #f1f1f1;
            letter-spacing: 0.5px;
        }

        .menu {
            display: flex;
            gap: 25px;
        }

        .menu a {
            text-decoration: none;
            color: #ffffff;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }

        .menu a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0%;
            height: 2px;
            background-color: #b35b00;
            transition: width 0.3s;
        }

        .menu a:hover {
            color: #b35b00;
        }

        .menu a:hover::after {
            width: 100%;
        }

        .login-btn a {
            background-color: #e97c00f8;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .login-btn a:hover {
            background-color: #8c4600;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(179, 91, 0, 0.4);
        }

        /* HERO */
        .hero {
            position: relative;
            width: 100%;
            height: 85vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(70%);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(250, 245, 245, 0.3), rgba(0,0,0,0.6));
        }

        .hero-content {
            position: absolute;
            text-align: center;
            color: #fff;
            max-width: 700px;
            padding: 20px;
            z-index: 2;
            animation: fadeIn 1.5s ease;
        }

        .hero-content h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            line-height: 1.3;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-content p {
            font-size: 1.05rem;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .btn-reservar {
            background-color: #b35b00;
            padding: 12px 28px;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .btn-reservar:hover {
            background-color: #8c4600;
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }

        /* FOOTER */
        .footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 0.9rem;
            margin-top: auto;
        }

        /* ANIMACIONES */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* RESPONSIVO */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px 25px;
                gap: 10px;
            }

            .menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .hero-content h2 {
                font-size: 1.8rem;
            }

            .hero-content p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                height: 75vh;
            }

            .hero-content h2 {
                font-size: 1.4rem;
            }

            .btn-reservar {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</body>
</html>