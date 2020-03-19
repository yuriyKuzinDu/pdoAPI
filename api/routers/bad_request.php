<?php
header('Content-type: application/json');
http_response_code($status);
echo json_encode([
    'method' => $method,
    'errors' => [
        'status' => $status,
        'error' => $error
    ]
]);