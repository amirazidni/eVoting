<?php
    $url = 'http://localhost:8081/evoting/api/pemilih/read_one.php?nim='.$_POST['nim'];
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, true);
?>