<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Medussa AI Chat</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; }
        .container { max-width: 480px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #bbb3; padding: 2em; }
        .chatbox { height: 300px; overflow-y: auto; background: #f9f9f9; padding: 1em; margin-bottom: 1em; border-radius: 8px; border: 1px solid #eee;}
        .msg { margin: 0.5em 0;}
        .msg.user { text-align: right; color: #1976d2; }
        .msg.ai { text-align: left; color: #222; }
        form { display: flex; }
        input[type=text] { flex: 1; padding: 0.6em; border-radius: 5px; border: 1px solid #ccc; }
        button { margin-left: 8px; padding: 0.6em 1.2em; border-radius: 5px; background: #1976d2; color: #fff; border: none; }
    </style>
</head>
<body>
<div class="container">
    <h2>Asistente IA Local Medussa</h2>
    <div class="chatbox" id="chatbox"></div>
    <form id="chatForm" autocomplete="off">
        <input type="text" id="userInput" placeholder="Escribe tu pregunta..." required autofocus>
        <button type="submit">Enviar</button>
    </form>
</div>
<script>
const chatbox = document.getElementById('chatbox');
const chatForm = document.getElementById('chatForm');
const userInput = document.getElementById('userInput');

// Inicializa conversación
let conversation = [];

function appendMsg(author, text) {
    const div = document.createElement('div');
    div.className = 'msg ' + author;
    div.innerText = text;
    chatbox.appendChild(div);
    chatbox.scrollTop = chatbox.scrollHeight;
}

chatForm.onsubmit = async function(e) {
    e.preventDefault();
    const userText = userInput.value.trim();
    if (!userText) return;
    appendMsg('user', userText);
    conversation.push({role: 'user', content: userText});
    userInput.value = '';
    appendMsg('ai', 'Pensando...');

    // SIMULACIÓN de IA local (sólo para pruebas)
    // Aquí conectarías vía fetch/ajax a tu backend local de IA real
    setTimeout(() => {
        // Simula respuesta IA
        let aiResponse = "Respuesta simulada de IA para: \"" + userText + "\"\n\n(Conecta aquí tu modelo local)";
        chatbox.lastChild.innerText = aiResponse;
        conversation.push({role: 'ai', content: aiResponse});
    }, 1000);
};
</script>
</body>
</html>
