<?php
header('Content-type: application/json');
http_response_code($status);
$response = [
    'method' => $method,
    'message' => $message,
    'data' => $responseBody
];
echo json_encode($response);
die();