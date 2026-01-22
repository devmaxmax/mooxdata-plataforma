<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Roboto', sans-serif;
        }

        body {
            background-color: #f4e2e3;
            /* Color de fondo principal */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(164, 71, 51, 0.15);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            border: 1px solid #e59c95;
        }

        /* ESPACIO PARA LOGO - PARTE SUPERIOR */
        .logo-section {
            background: linear-gradient(135deg, #c44424 0%, #b55749 100%);
            padding: 50px 20px 30px;
            text-align: center;
            position: relative;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-bottom: 3px solid #a24733;
        }

        .logo-placeholder {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 20px rgba(164, 71, 51, 0.3);
            backdrop-filter: blur(5px);
        }

        .logo-placeholder i {
            font-size: 48px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .logo-text {
            color: white;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .logo-subtitle {
            color: #dda48c;
            font-size: 14px;
            margin-top: 8px;
            font-weight: 500;
        }

        /* FORMULARIO */
        .form-section {
            padding: 40px 40px 30px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #a24733;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 18px;
            border: 2px solid #e59c95;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fcf8f7;
            color: #a24733;
        }

        .form-group input:focus {
            outline: none;
            border-color: #c44424;
            background: white;
            box-shadow: 0 0 0 4px rgba(196, 68, 36, 0.12);
        }

        .form-group input::placeholder {
            color: #d08173;
            opacity: 0.8;
        }

        /* CHECKBOX MÁS VISIBLE */
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding: 12px 0;
            border-top: 1px solid #f4e2e3;
            border-bottom: 1px solid #f4e2e3;
        }

        .remember-me input {
            margin-right: 12px;
            width: 20px;
            height: 20px;
            accent-color: #c44424;
            cursor: pointer;
        }

        .remember-me label {
            color: #b4543a;
            font-weight: 500;
            cursor: pointer;
            font-size: 15px;
        }

        /* BOTÓN PRINCIPAL */
        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(to right, #c44424, #b55749);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            background: linear-gradient(to right, #b4543a, #a24733);
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(196, 68, 36, 0.25);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .submit-btn:hover::after {
            left: 100%;
        }

        .info-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #f4e2e3;
            color: #b55749;
            font-size: 13px;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
                border-radius: 16px;
            }

            .form-section {
                padding: 30px 25px 20px;
            }

            .logo-section {
                padding: 40px 20px 25px;
                min-height: 160px;
            }

            .logo-placeholder {
                width: 85px;
                height: 85px;
                margin-bottom: 15px;
            }

            .logo-placeholder i {
                font-size: 40px;
            }

            .logo-text {
                font-size: 24px;
            }

            .form-group input {
                padding: 14px 16px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        @keyframes logoGlow {

            0%,
            100% {
                box-shadow: 0 8px 20px rgba(164, 71, 51, 0.3);
            }

            50% {
                box-shadow: 0 8px 25px rgba(164, 71, 51, 0.4);
            }
        }

        .logo-placeholder {
            animation: logoGlow 3s ease-in-out infinite;
        }

        input:focus-visible {
            outline: 2px solid #c44424;
            outline-offset: 2px;
        }

        .color-palette-info {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-placeholder">
                <i class="fas fa-lock"></i>
            </div>
            <h1 class="logo-text">Acceso Seguro</h1>
            <p class="logo-subtitle">Sistema de autenticación</p>
        </div>

        <div class="form-section">
            <form method="POST" action="{{ route('burra.login.panel') }}">
                @csrf

                @if ($errors->any())
                    <div
                        style="background-color: #fde8e8; border: 1px solid #f98080; color: #c81e1e; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li style="font-size: 14px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Usuario</label>
                    <input type="text" id="name" name="name" placeholder="Ingrese su usuario" required
                        value="{{ old('name') }}" autocomplete="username">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required
                        autocomplete="current-password">
                </div>

                <button type="submit" class="submit-btn" id="btn-submit">Ingresar</button>
            </form>
        </div>
    </div>

    <script>
        // Simple visual feedback on submit
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.textContent = 'Verificando...';
            btn.disabled = true;
            btn.style.opacity = '0.8';
        });

        // Instrucciones para agregar logo
        console.log('%c🎨 PALETA DE COLORES UTILIZADA:', 'color: #c44424; font-weight: bold; font-size: 14px;');
        console.log('%c#f4e2e3 - Fondo principal', 'color: #f4e2e3; background: #333; padding: 2px 5px;');
        console.log('%c#c44424 - Color principal/button', 'color: #c44424; background: #333; padding: 2px 5px;');
        console.log('%c#b55749 - Gradiente secundario', 'color: #b55749; background: #333; padding: 2px 5px;');
        console.log('%c#a24733 - Acentos/bordes', 'color: #a24733; background: #333; padding: 2px 5px;');
        console.log('%c#e59c95 - Bordes inputs', 'color: #e59c95; background: #333; padding: 2px 5px;');
        console.log('%c#d08173 - Placeholder', 'color: #d08173; background: #333; padding: 2px 5px;');
        console.log('%c#dda48c - Texto secundario', 'color: #dda48c; background: #333; padding: 2px 5px;');
        console.log('%c#b4543a - Texto/checkbox', 'color: #b4543a; background: #333; padding: 2px 5px;');
    </script>
</body>

</html>
