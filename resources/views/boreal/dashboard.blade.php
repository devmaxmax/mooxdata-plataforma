<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Boreal - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #00f2ff;
            --secondary: #7000ff;
            --bg-dark: #0a0a12;
            --bg-lighter: #161623;
            --text-light: #f0f0f0;
            --text-muted: #888;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-hover: rgba(255, 255, 255, 0.1);
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: 'Roboto', sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        h1,
        h2,
        h3 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--bg-lighter);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            color: var(--primary);
            margin: 0;
            font-size: 24px;
        }

        .menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            flex-grow: 1;
        }

        .menu li {
            padding: 15px 20px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-muted);
            border-left: 4px solid transparent;
        }

        .menu li:hover {
            background-color: var(--glass-hover);
            color: var(--text-light);
        }

        .menu li.active {
            background-color: var(--glass);
            color: var(--primary);
            border-left: 4px solid var(--primary);
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: flex-end;
            padding-bottom: 20px;
            position: relative;
        }

        .user-menu-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .user-name {
            font-size: 14px;
            font-weight: bold;
            color: var(--text-light);
            font-family: 'Montserrat', sans-serif;
        }

        .user-icon {
            background: var(--glass);
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s;
            font-size: 20px;
            color: var(--primary);
        }

        .user-icon:hover {
            background: rgba(0, 242, 255, 0.1);
        }

        .dropdown-menu {
            position: absolute;
            top: 70px;
            right: 0;
            background: var(--bg-lighter);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            width: 200px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            display: none;
            flex-direction: column;
            z-index: 100;
        }

        .dropdown-menu.show {
            display: flex;
            animation: fadeIn 0.2s ease-in-out;
        }

        .dropdown-item {
            padding: 15px 20px;
            color: var(--text-light);
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
        }

        .dropdown-item:hover {
            background: var(--glass-hover);
            color: var(--primary);
        }

        .dropdown-item.text-danger {
            color: #ff4d4d;
        }

        .dropdown-item.text-danger:hover {
            color: #ff4d4d;
            background: rgba(255, 77, 77, 0.1);
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-overlay.show {
            display: flex;
            animation: fadeIn 0.3s;
        }

        .modal-content {
            background: var(--bg-lighter);
            padding: 30px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            margin: 0;
            color: var(--primary);
        }

        .modal-close {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 20px;
        }

        .modal-close:hover {
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 20px;
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
            outline: none;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: var(--primary);
        }

        .btn {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-delete {
            background: transparent;
            color: #ff4d4d;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
            padding: 5px;
        }

        .btn-delete:hover {
            color: #ff1a1a;
            transform: scale(1.1);
        }

        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: rgba(0, 242, 255, 0.1);
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .alert-error {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            border: 1px solid #ff4d4d;
        }


        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-title {
            margin-bottom: 30px;
            font-size: 28px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Tables */
        .table-container {
            background: var(--glass);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        th {
            background-color: rgba(0, 0, 0, 0.2);
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
            vertical-align: top;
        }

        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .badge {
            background: rgba(0, 242, 255, 0.1);
            color: var(--primary);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .chat-bubble {
            background: rgba(255, 255, 255, 0.05);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            font-style: italic;
        }

        .bot-bubble {
            background: rgba(0, 242, 255, 0.05);
            border-left: 2px solid var(--primary);
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Boreal</h2>
        </div>
        <ul class="menu">
            <li class="active" onclick="switchTab('mensajes', this)">
                <i class="fa-solid fa-envelope"></i> Mensajes
            </li>
            <li onclick="switchTab('logbot', this)">
                <i class="fa-solid fa-robot"></i> LogBot
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Top Bar -->
        <div class="top-bar">
            <div class="user-menu-btn" onclick="toggleDropdown()">
                <span class="user-name">{{ $loggedUser->name ?? '' }}</span>
                <div class="user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <div class="dropdown-menu" id="userDropdown">
                <button class="dropdown-item" onclick="openPasswordModal()">
                    <i class="fa-solid fa-key"></i> Cambiar contraseña
                </button>
                <form action="{{ route('boreal.logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fa-solid fa-right-from-bracket"></i> Salir
                    </button>
                </form>
            </div>
        </div>

        <!-- Tab: Mensajes -->
        <div id="mensajes" class="tab-content active">
            <h2 class="page-title">Mensajes Recibidos</h2>

            @if(session('message_success'))
            <div class="alert alert-success">{{ session('message_success') }}</div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Empresa</th>
                            <th>Email</th>
                            <th>Mensaje / Desafío</th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                        <tr>
                            <td style="white-space: nowrap;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $msg->company }}</strong></td>
                            <td>{{ $msg->email }}</td>
                            <td>{{ $msg->message }}</td>
                            <td>
                                <form action="{{ route('boreal.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este mensaje? Esta acción no se puede deshacer.');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Eliminar mensaje">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;">No hay mensajes registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab: LogBot -->
        <div id="logbot" class="tab-content">
            <h2 class="page-title">Logs del Bot IA</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>IP</th>
                            <th style="width: 35%;">Mensaje del Usuario</th>
                            <th style="width: 45%;">Respuesta del Bot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td style="white-space: nowrap;">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td><span class="badge">{{ $log->ip_address ?? 'Desconocida' }}</span></td>
                            <td>
                                <div class="chat-bubble">
                                    "{{ $log->user_message }}"
                                </div>
                            </td>
                            <td>
                                <div class="bot-bubble">
                                    {{ $log->bot_response }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px;">No hay interacciones registradas con el bot.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Password Modal -->
    <div class="modal-overlay" id="passwordModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Cambiar Contraseña</h3>
                <button class="modal-close" onclick="closePasswordModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>

            @if(session('password_success'))
            <div class="alert alert-success">{{ session('password_success') }}</div>
            @endif
            @if(session('password_error'))
            <div class="alert alert-error">{{ session('password_error') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('boreal.change-password') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Contraseña Actual</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>Nueva Contraseña</label>
                    <input type="password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label>Confirmar Nueva Contraseña</label>
                    <input type="password" name="new_password_confirmation" required>
                </div>
                <button type="submit" class="btn">Actualizar Contraseña</button>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tabId, element) {
            // Update active menu item
            document.querySelectorAll('.menu li').forEach(li => li.classList.remove('active'));
            element.classList.add('active');

            // Update active tab content
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
        }

        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('.user-menu-btn') && !event.target.closest('.dropdown-menu')) {
                const dropdowns = document.getElementsByClassName("dropdown-menu");
                for (let i = 0; i < dropdowns.length; i++) {
                    if (dropdowns[i].classList.contains('show')) {
                        dropdowns[i].classList.remove('show');
                    }
                }
            }
        }

        function openPasswordModal() {
            document.getElementById('passwordModal').classList.add('show');
            document.getElementById('userDropdown').classList.remove('show');
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.remove('show');
        }

        // Auto-open modal if there are errors or success message
        @if(session('password_success') || session('password_error') || $errors->any())
        openPasswordModal();
        @endif
    </script>
</body>

</html>