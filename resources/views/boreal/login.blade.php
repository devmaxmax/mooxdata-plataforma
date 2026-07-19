<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Boreal - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #00f2ff;
            --secondary: #7000ff;
            --bg-dark: #0a0a12;
            --text-light: #f0f0f0;
            --glass: rgba(255, 255, 255, 0.05);
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1, h2, h3 {
            font-family: 'Montserrat', sans-serif;
        }

        .login-container {
            background: var(--glass);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 30px;
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: var(--text-light);
            font-family: 'Roboto', sans-serif;
            outline: none;
            transition: 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
        }

        .btn {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
            font-family: 'Montserrat', sans-serif;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 242, 255, 0.4);
        }

        .error {
            color: #ff4d4d;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Panel Boreal</h2>
        @if($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif
        <form action="{{ route('boreal.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>
    </div>

</body>
</html>
