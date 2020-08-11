<?php

$url = 'http://localhost:8081/evoting/api/pemilih/update.php';

$ch = curl_init($url);
    # nim, nomor_urut insert ke tabel pilihan
    # vote update ke tabel calon
$payload = json_encode(array(
    'nim' => @$nim,
    'nomor_urut' => @$pilihan,
    'vote' => @$total_vote
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
?>