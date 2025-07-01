<?php
// Solo responde a POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['prompt'] ?? '');

    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'No input']);
        exit;
    }

    // Llama al modelo local de Ollama
    $data = [
        'model' => 'llama3',
        'prompt' => $input,
        'stream' => false
    ];
    $ch = curl_init('http://localhost:11434/api/generate');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);
    if (isset($response['response'])) {
        echo json_encode(['answer' => $response['response']]);
    } else {
        echo json_encode(['error' => 'Sin respuesta de Ollama']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>IA Local Medussa</title>
</head>
<body>
  <h2>IA Local - Medussa (Ollama)</h2>
  <form id="chatForm">
    <input type="text" id="userInput" autocomplete="off" placeholder="Pregunta algo..." />
    <button type="submit">Enviar</button>
  </form>
  <div id="chatbox" style="margin-top:20px;max-width:600px;"></div>
  <script>
    const chatbox = document.getElementById('chatbox');
    const chatForm = document.getElementById('chatForm');
    const userInput = document.getElementById('userInput');

    function appendMsg(author, text) {
      const div = document.createElement('div');
      div.style.margin = '10px 0';
      div.innerHTML = (author === 'user' ? '<b>Tú:</b> ' : '<b>IA:</b> ') + text;
      chatbox.appendChild(div);
      chatbox.scrollTop = chatbox.scrollHeight;
    }

    chatForm.onsubmit = async function(e) {
      e.preventDefault();
      const userText = userInput.value.trim();
      if (!userText) return;
      appendMsg('user', userText);
      userInput.value = '';
      appendMsg('ai', '<i>Pensando...</i>');
      try {
        const response = await fetch('', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'prompt=' + encodeURIComponent(userText)
        });
        const data = await response.json();
        chatbox.lastChild.remove(); // quita "Pensando..."
        if (data.answer) appendMsg('ai', data.answer);
        else appendMsg('ai', 'Error: ' + (data.error || 'Sin respuesta'));
      } catch {
        chatbox.lastChild.remove();
        appendMsg('ai', 'Error en la conexión.');
      }
    };
  </script>
</body>
</html>
