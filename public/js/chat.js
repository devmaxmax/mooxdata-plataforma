const chatToggleBtn = document.getElementById('chatToggleBtn');
const chatWindow = document.getElementById('chatWindow');
const closeChatBtn = document.getElementById('closeChatBtn');
const chatInput = document.getElementById('chatInput');
const sendBtn = document.getElementById('sendBtn');
const chatBody = document.getElementById('chatBody');

let conversationHistory = [];

if (chatToggleBtn && chatWindow && closeChatBtn && chatInput && sendBtn && chatBody) {
    chatToggleBtn.addEventListener('click', () => {
        const isHidden = window.getComputedStyle(chatWindow).display === 'none';
        chatWindow.style.display = isHidden ? 'flex' : 'none';
        if (isHidden) chatInput.focus();
    });

    closeChatBtn.addEventListener('click', () => {
        chatWindow.style.display = 'none';
    });

    async function sendMessage() {
        const messageText = chatInput.value.trim();
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (messageText === "") return;

        addMessage(messageText, 'user-message');
        chatInput.value = '';
        chatInput.disabled = true;
        sendBtn.disabled = true;

        conversationHistory.push({ role: 'user', content: messageText });

        try {
            const response = await window.axios.post(getChat, {
                messages: conversationHistory,
                _token: token
            });

            const reply = response.data.reply || response.data['ia-reply'];

            if (reply) {
                addMessage(reply, 'bot-message');
                conversationHistory.push({ role: 'assistant', content: reply });
            } else {
                console.error("Respuesta vacía del servidor:", response.data);
            }

        } catch (error) {
            console.error('Error enviando mensaje:', error);
            addMessage("Lo siento, hubo un error al conectar con el servidor. Intenta nuevamente.", 'bot-message');
            conversationHistory.pop();
        } finally {
            chatInput.disabled = false;
            sendBtn.disabled = false;
            chatInput.focus();
        }
    }

    function addMessage(text, className) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', className);
        messageDiv.textContent = text;
        chatBody.appendChild(messageDiv);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
}
