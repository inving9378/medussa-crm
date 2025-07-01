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
<?php
// ai_backend.php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['prompt'])) {
    echo json_encode(['error' => 'Falta el prompt']);
    exit;
}

// Construye el request para Ollama local
$model = 'phi'; // Puedes cambiarlo a cualquier modelo instalado
$ollama_url = 'http://localhost:11434/api/generate';

$body = [
    'model' => $model,
    'prompt' => $data['prompt'],
    'stream' => false
];

$ch = curl_init($ollama_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
$response = curl_exec($ch);

if ($response === false) {
    echo json_encode(['error' => 'No se pudo conectar a Ollama']);
    exit;
}

$result = json_decode($response, true);
$answer = $result['response'] ?? 'No response from model.';

echo json_encode(['answer' => $answer]);

</body>
</html>
