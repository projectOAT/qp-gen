<?php
// chatbot.php

header('Content-Type: application/json');

// Get the user's message from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$userMessage = $data['message'];

// Call the LLaMA model API
$llamaResponse = callLlamaModel($userMessage);

// Return the response
echo json_encode(['response' => $llamaResponse]);

function callLlamaModel($message) {
    // Replace with your LLaMA model API endpoint
    $url = 'http://127.0.0.1:1234';

    // Prepare the data to send
    $postData = json_encode(['message' => $message]);

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Execute the request
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response
    $responseData = json_decode($response, true);

    // Return the chatbot's response
    return $responseData['response'] ?? 'Sorry, I could not understand that.';
}
?>