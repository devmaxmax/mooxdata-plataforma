<?php

require __DIR__ . '/vendor/autoload.php';

$apiKey = trim('00003:315699');
$apiSecret = trim('tO3D4g73UAE71hcG3yZ55HoMsX8vMCi7');

echo "1. Requesting Token from https://auth.fu.do/api ...\n";

$authUrl = 'https://auth.fu.do/api';

// Try regular
echo "  Attempt 1: Raw ClientID ($apiKey)\n";
$payload = json_encode(['apiKey' => $apiKey, 'apiSecret' => $apiSecret]);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $authUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$result = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($code !== 200) {
    echo "  -> Failed ($code). Attempt 2: Decoded '00003:315699' as apiKey...\n";
    // Assuming format "Group:User" or similar? The screenshot said "Client Id".
    // Let's try the whole decoded string "00003:315699"
    $decoded = '00003:315699'; 
    $payload = json_encode(['apiKey' => $decoded, 'apiSecret' => $apiSecret]);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $authUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
}


echo "HTTP Code: $code\n";
echo "Response: $result\n";

$data = json_decode($result, true);

if (!isset($data['token'])) {
    echo "ERROR: No token received.\n";
    exit(1);
}

$token = $data['token'];
echo "\n2. Token received! (Exp: " . date('Y-m-d H:i:s', $data['exp']) . ")\n";
echo "Token verified. Now testing API access with token...\n";

$apiUrl = 'https://api.fu.do/v1alpha1/sales?page%5Bsize%5D=1'; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $token",
    "Accept: application/json"
]);

$apiResult = curl_exec($ch);
$apiCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "\nAPI HTTP Code: $apiCode\n";
echo "API Response Snippet: " . substr($apiResult, 0, 200) . "...\n";
