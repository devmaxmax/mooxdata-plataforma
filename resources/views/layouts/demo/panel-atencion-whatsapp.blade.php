<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin WhatsApp</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('demo/whatsapp/css/style.css') }}">
</head>

<body>

    <div class="app-container">
        <nav class="sidebar">
            <div class="logo"><i class="ph ph-whatsapp-logo"></i></div>
            <div class="nav-item active" title="Chats"><i class="ph ph-chat-circle-dots"></i></div>
        </nav>

        <div class="chat-list-panel">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Buscar o iniciar un nuevo chat">
            </div>
            <div class="filter-tags">
                <span class="tag active">Todos</span>
                <span class="tag">No leídos</span>
                <span class="tag">Pendientes</span>
                <span class="tag">Grupos</span>
            </div>
            <div class="contacts-list" id="contactsList">
            </div>
        </div>

        <div class="chat-window" id="chatWindow">
            <div class="chat-header">
                <div class="header-info">
                    <img id="currentAvatar" src="https://i.pravatar.cc/100?img=1" class="avatar">
                    <div class="header-text">
                        <span id="currentName" class="header-name">Carlos Cliente</span>
                        <span class="header-status">en línea</span>
                    </div>
                </div>
                <div class="header-actions">
                    <i class="ph ph-magnifying-glass"></i>
                    <i class="ph ph-paperclip"></i>
                    <i class="ph ph-dots-three-vertical"></i>
                </div>
            </div>

            <div class="messages-area" id="messagesArea">
                <div class="message received">
                    Hola, quisiera consultar sobre el precio de sus servicios.
                    <span class="msg-time">10:30 AM</span>
                </div>
                <div class="message sent">
                    ¡Hola Carlos! Claro que sí. El plan cuesta $0/mes.
                    <span class="msg-time">10:32 AM <i class="ph ph-checks" style="color: #53bdeb;"></i></span>
                </div>
                <div class="message received">
                    Perfecto, ¿incluye soporte técnico 24/7?
                    <span class="msg-time">10:33 AM</span>
                </div>
            </div>

            <div class="chat-input-area">
                <i class="ph ph-smiley btn-icon"></i>
                <i class="ph ph-plus btn-icon"></i>
                <input type="text" class="input-box" id="messageInput" placeholder="Escribe un mensaje">
                <i class="ph ph-microphone btn-icon"></i>
                <i class="ph ph-paper-plane-right btn-icon" style="color: var(--primary)" onclick="sendMessage()"></i>
            </div>
        </div>
    </div>

    <script src="{{ asset('demo/whatsapp/js/app.js') }}"></script>

</body>

</html>
