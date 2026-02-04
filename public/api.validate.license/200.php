<?php

header('Content-Type: application/json');

// Define valid purchase codes (add or modify as needed)
$validCodes = [
    'YOUR-PURCHASE-CODE-HERE',
    'VALID-LICENSE-KEY-123',
    'ANOTHER-VALID-CODE'
];

// Get the code from request
$requestedCode = $_GET['code'] ?? '';

// Check if the code is valid
if (in_array($requestedCode, $validCodes)) {
    header('HTTP/1.1 200 OK');
    $response = [
        "amount" => "58.00",
        "sold_at" => date('c'), // Current timestamp in ISO 8601 format
        "license" => "regular",
        "support_amount" => "16.88",
        "buyer" => "licensed_user",
        "purchase_count" => 1,
        "item" => [
            "id" => 123456,
            "name" => "DigiBank",
            "author_username" => "remotelywork",
            "author_url" => "https://codecanyon.net/user/remotelywork",
            "url" => "https://codecanyon.net/item/digibank/123456"
        ]
    ];
    echo json_encode($response);
} else {
    // Return error for invalid code
    header('HTTP/1.1 404 Not Found');
    $response = [
        "error" => "Invalid purchase code"
    ];
    echo json_encode($response);
}

exit;
