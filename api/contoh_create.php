<?php
// Contoh post json dengan php curl
// uji api juga bisa menggunakan Postman: https://www.postman.com/downloads/

// API URL 
$url = 'http://localhost:8081/api/product/create.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
// $data = 
$payload = json_encode(array(
    'name' => 'UWUWWW 2.0',
    'price' => '199',
    'description' => 'The best pillow for amazing programmers.',
    'category_id' => 2,
    'created' => '2018-06-01 00:35:07'
));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);
echo $payload;
?>