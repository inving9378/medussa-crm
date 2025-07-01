<?php
header('Content-Type: application/json');

// Solo aceptar peticiones POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Leer el texto del usuario
$input = trim($_POST['prompt'] ?? '');

// Si viene vacío, error
if (!$input) {
    echo json_encode(['error' => 'Falta el prompt']);
    exit;
}

// Construir el payload para Ollama
$data = [
    'model' => 'llama3', // Cambia a tu modelo si tienes otro
    'prompt' => $input,
    'stream' => false
];

$ch = curl_init('http://localhost:11434/api/generate');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

if (isset($response['response'])) {
    echo json_encode(['answer' => $response['response']]);
} else {
    echo json_encode(['error' => 'No hubo respuesta de Ollama', 'detalle' => $result]);
}
exit;
