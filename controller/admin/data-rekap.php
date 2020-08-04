<?php
    require_once "../../api/config/database.php";
    $query_pilihan = mysqli_query($kon, "SELECT nomor_urut,nama1,nama2,vote FROM calon");
    $result = array();

    while($row = mysqli_fetch_array($query_pilihan)){
        array_push($result, array('nomor_urut' => $row[0],
                                  'nama' => $row[1]." - ".$row[2],
                                  'suara' => $row[3]));
    };


    print_r($result = json_encode($result, JSON_PRETTY_PRINT));
?>