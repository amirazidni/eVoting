<?php

$url = 'http://localhost:8081/evoting/api/pemilih/update.php';

$ch = curl_init($url);
    # nim, nomor_urut insert ke tabel pilihan
    # vote update ke tabel calon
$data_kirim = json_encode(array(
    'nim' => @$nim,
    'nomor_urut' => @$pilihan,
    'vote' => @$total_vote
));

curl_setopt($ch, CURLOPT_POSTFIELDS, $data_kirim);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

curl_close($ch);
?>