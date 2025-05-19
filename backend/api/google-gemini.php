<?php
session_start(); // Start the session to store chat history

// --- CONFIGURATION ---

$chatModel = 'google/gemini-2.0-flash-exp:free';
$imageGenerationModel = 'playgroundai/playground-v2.5';
$imageCommand = '/image'; // Command to trigger image generation

// --- FUNCTIONS ---
function callOpenRouterAPI(string $apiKey, string $model, $payloadData, string $requestType = 'chat'): mixed
{
    $url = $requestType === 'chat' ? 'https://openrouter.ai/api/v1/chat/completions' : 'https://openrouter.ai/api/v1/images/generations';
    $data = $requestType === 'chat' ? ['model' => $model, 'messages' => $payloadData] : [
        'model' => $model,
        'prompt' => $payloadData,
        'n' => 1,
        'size' => '1024x1024',
        'negative_prompt' => 'text, words, letters, characters, typography, font, signature, watermark, logo, label, caption, writing, title, heading, numbers, digits, blurry text, unreadable text, scribbles, artifacts, malformed, ugly, tiling, poorly drawn hands, poorly drawn feet, poorly drawn face, out of frame, extra limbs, disfigured, deformed, body out of frame, bad anatomy, watermark, grainy, signature, cut off, draft, duplicate, morbid, mutilated, extra fingers, mutated hands, cloned face, bad art, jpeg artifacts, lowres'
    ];

    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
        'HTTP-Referer: https://your-app-domain.com',
        'X-Title: Your App Name Chatbot',
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        error_log("cURL Error ({$requestType} to {$model}): " . curl_error($ch));
        return ['error' => "Request Error: Could not connect to API for {$requestType}."];
    }

    curl_close($ch);
    $result = json_decode($response, true);

    if ($httpCode !== 200) {
        $apiErrorMessage = $result['error']['message'] ?? 'Unexpected API response format (non-200).';
        error_log("OpenRouter API Error ({$requestType} to {$model} - HTTP {$httpCode}): " . json_encode($result));
        return ['error' => "API Error (HTTP {$httpCode}) for {$requestType}: {$apiErrorMessage}"];
    }

    return $requestType === 'chat' ? ($result['choices'][0]['message']['content'] ?? null) : array_column($result['data'], 'url');
}

// --- CHAT LOGIC ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = trim($_POST['user_message'] ?? '');

    if (empty($userMessage)) {
        echo json_encode(['error' => "Please enter a message."]);
        exit;
    }

    $_SESSION['chat_history'][] = ['role' => 'user', 'content' => $userMessage, 'type' => 'text'];

    $requestType = 'chat';
    $apiPayload = [];
    $modelToUse = $chatModel;

    if (strpos(strtolower($userMessage), strtolower($imageCommand) . ' ') === 0) {
        $prompt = trim(substr($userMessage, strlen($imageCommand) + 1));
        if (!empty($prompt)) {
            $requestType = 'image';
            $apiPayload = $prompt;
            $modelToUse = $imageGenerationModel;
            $_SESSION['chat_history'][count($_SESSION['chat_history']) - 1]['content'] = "You asked to generate an image for: \"{$prompt}\"";
        } else {
            echo json_encode(['error' => "Please provide a prompt after the '{$imageCommand}' command. Example: {$imageCommand} a cute cat."]);
            exit;
        }
    } else {
        $historyForContext = array_slice($_SESSION['chat_history'], -10);
        foreach ($historyForContext as $entry) {
            if ($entry['type'] === 'text') {
                $apiPayload[] = ['role' => $entry['role'], 'content' => $entry['content']];
            }
        }
    }

    if (!empty($apiPayload)) {
        $assistantResponse = callOpenRouterAPI($apiKey, $modelToUse, $apiPayload, $requestType);

        if ($assistantResponse !== null) {
            if ($requestType === 'image') {
                $_SESSION['chat_history'][] = ['role' => 'assistant', 'content' => $assistantResponse, 'type' => 'image_urls'];
                echo json_encode(['type' => 'image', 'content' => $assistantResponse]);
            } else {
                $_SESSION['chat_history'][] = ['role' => 'assistant', 'content' => $assistantResponse, 'type' => 'text'];
                echo json_encode(['type' => 'text', 'content' => $assistantResponse]);
            }
        } else {
            echo json_encode(['error' => "Sorry, I couldn't process that request."]);
        }
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Handle clear history action
    if (isset($input['action']) && $input['action'] === 'clear_history') {
        $_SESSION['chat_history'] = [];
        echo json_encode(['success' => true]);
        exit;
    }

    $userMessage = trim($_POST['user_message'] ?? '');
    $uploadedFile = $_FILES['file'] ?? null;

    // Existing logic for handling messages and file uploads...
}
    exit;
}