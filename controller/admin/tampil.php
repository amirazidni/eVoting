<?php
    require_once "../../api/config/database.php";
    $query_pemilih = mysqli_query($kon, "SELECT COUNT('id') FROM pemilih");
    $hasil_pemilih = mysqli_fetch_array($query_pemilih);
    $query_calon = mysqli_query($kon, "SELECT COUNT('id') FROM calon");
    $hasil_calon = mysqli_fetch_array($query_calon);
    $query_pilihan = mysqli_query($kon, "SELECT COUNT('id') FROM pilihan");
    $hasil_pilihan = mysqli_fetch_array($query_pilihan);
    $sisa = $hasil_pemilih[0] - $hasil_pilihan[0]; 

    $result = array('pemilih' => $hasil_pemilih[0],
                    'calon' => $hasil_calon[0],
                    'pilihan' => $hasil_pilihan[0],
                    'sisa' => $sisa);
    echo $result = json_encode($result, JSON_PRETTY_PRINT);
?>