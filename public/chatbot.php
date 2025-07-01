<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$prompt = $data['prompt'] ?? '';

if (empty($prompt)) {
    echo json_encode(['response' => 'No prompt provided']);
    exit;
}

$body = json_encode([
    'model' => 'phi3', // O el nombre del modelo que instalaste
    'prompt' => $prompt,
    'stream' => false
]);

$ch = curl_init('http://localhost:11434/api/generate');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);
echo json_encode(['response' => $json['response'] ?? 'Error de IA']);
