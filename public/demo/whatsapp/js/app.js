        const chatsData = [{
                id: 1,
                name: "Carlos",
                msg: "¿incluye soporte técnico 24/7?",
                time: "10:33 AM",
                img: "https://i.pravatar.cc/100?img=8",
                unread: 0
            },
            {
                id: 2,
                name: "Soporte Técnico",
                msg: "El ticket #402 ha sido resuelto.",
                time: " Ayer",
                img: "https://i.pravatar.cc/100?img=12",
                unread: 2
            },
            {
                id: 3,
                name: "María Ventas",
                msg: "Gracias por la información.",
                time: "Ayer",
                img: "https://i.pravatar.cc/100?img=5",
                unread: 0
            },
            {
                id: 4,
                name: "Grupo Devs",
                msg: "Juan: Revisen el deploy en prod.",
                time: "Martes",
                img: "https://i.pravatar.cc/100?img=60",
                unread: 5
            },
            {
                id: 5,
                name: "Ana Marketing",
                msg: "Te envié el PDF de la campaña.",
                time: "Lunes",
                img: "https://i.pravatar.cc/100?img=9",
                unread: 0
            },
            {
                id: 6,
                name: "Nuevo Lead",
                msg: "Hola, me interesa su servicio.",
                time: "Lunes",
                img: "https://i.pravatar.cc/100?img=3",
                unread: 1
            },
        ];

        const contactsList = document.getElementById('contactsList');
        const messagesArea = document.getElementById('messagesArea');
        const messageInput = document.getElementById('messageInput');

        function renderChats() {
            contactsList.innerHTML = '';
            chatsData.forEach(chat => {
                const activeClass = chat.id === 1 ? 'active' : '';
                const badge = chat.unread > 0 ? `<div class="unread-badge">${chat.unread}</div>` : '';

                const html = `
                <div class="contact-item ${activeClass}" onclick="loadChat(${chat.id}, this)">
                    <img src="${chat.img}" class="avatar">
                    <div class="contact-info">
                        <div class="contact-top">
                            <span class="contact-name">${chat.name}</span>
                            <span class="contact-time">${chat.time}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between;">
                            <span class="contact-msg">${chat.msg}</span>
                            ${badge}
                        </div>
                    </div>
                </div>
            `;
                contactsList.innerHTML += html;
            });
        }

        function loadChat(id, element) {
            document.querySelectorAll('.contact-item').forEach(el => el.classList.remove('active'));
            element.classList.add('active');

            const user = chatsData.find(c => c.id === id);
            document.getElementById('currentName').innerText = user.name;
            document.getElementById('currentAvatar').src = user.img;

            messagesArea.innerHTML = `
            <div class="message received" style="align-self:center; background:#e1f5fe; border-radius:8px; font-size:12px; color:#555;">
                Has iniciado conversación con <strong>${user.name}</strong>
            </div>
            <div class="message received">
                ${user.msg}
                <span class="msg-time">${user.time}</span>
            </div>
        `;
        }

        function sendMessage() {
            const text = messageInput.value.trim();
            if (text === "") return;

            const msgDiv = document.createElement('div');
            msgDiv.classList.add('message', 'sent');
            msgDiv.innerHTML = `
            ${text}
            <span class="msg-time">Ahora <i class="ph ph-checks" style="color: #999;"></i></span>
        `;

            messagesArea.appendChild(msgDiv);
            messageInput.value = '';

            messagesArea.scrollTop = messagesArea.scrollHeight;

            setTimeout(() => {
                const replyDiv = document.createElement('div');
                replyDiv.classList.add('message', 'received');
                replyDiv.innerHTML =
                    `Gracias por tu mensaje, esto es una respuesta de prueba del sistema de atención de agentes de IA. <span class="msg-time">Ahora</span>`;
                messagesArea.appendChild(replyDiv);
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }, 1500);
        }

        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });
        renderChats();