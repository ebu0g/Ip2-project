<?php
$apiUrl = "https://api-inference.huggingface.co/models/gpt2";
$apiKey = "PeFGT0uHRrx5zLRgQFnyYSZEAKIHrlOJxZj0YFGG"; // Get your free API key from Hugging Face

$data = [
    "inputs" => "What is the engineering design process?"
];

$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json"
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>