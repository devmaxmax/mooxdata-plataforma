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

        h1, h2, h3 {
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

        .logout-btn {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .logout-btn form button {
            background: rgba(255, 77, 77, 0.1);
            color: #ff4d4d;
            border: 1px solid #ff4d4d;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        .logout-btn form button:hover {
            background: #ff4d4d;
            color: white;
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
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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

        th, td {
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
        <div class="logout-btn">
            <form action="{{ route('boreal.logout') }}" method="POST">
                @csrf
                <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Salir</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Tab: Mensajes -->
        <div id="mensajes" class="tab-content active">
            <h2 class="page-title">Mensajes Recibidos</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Empresa</th>
                            <th>Email</th>
                            <th>Mensaje / Desafío</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                            <tr>
                                <td style="white-space: nowrap;">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                                <td><strong>{{ $msg->company }}</strong></td>
                                <td>{{ $msg->email }}</td>
                                <td>{{ $msg->message }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px;">No hay mensajes registrados.</td>
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

    <script>
        function switchTab(tabId, element) {
            // Update active menu item
            document.querySelectorAll('.menu li').forEach(li => li.classList.remove('active'));
            element.classList.add('active');

            // Update active tab content
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
        }
    </script>
</body>
</html>
