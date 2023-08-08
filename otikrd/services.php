<?php
// Define the valid token
$valid_token = 'otik1234';

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the token is provided in the request headers
    $headers = apache_request_headers();
    if (isset($headers['Authorization']) && $headers['Authorization'] === 'Bearer ' . $valid_token) {
        // Get the JSON data from the request body
        $json_data = file_get_contents('php://input');
        
        // Attempt to decode the JSON data
        $data = json_decode($json_data, true);
        
        if ($data === null) {
            // JSON decoding failed
            $response = array('error' => 'Invalid JSON data');
        } else {
            // JSON decoding successful
            $response = array('message' => 'Data received successfully', 'data' => $data);
        }
    } else {
        // Unauthorized
        $response = array('error' => 'Unauthorized');
    }
} else {
    // Method not allowed
    $response = array('error' => 'Method not allowed');
}

// Send the response
echo json_encode($response);
?>
