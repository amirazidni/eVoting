<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/calon.php';
  
$database = new Database();
$db = $database->getConnection();
$category = new Calon($db);
$stmt = $category->read();
$num = $stmt->rowCount();
if($num>0){  
    $categories_arr=array();
    $categories_arr["records"]=array();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item=array(
            "nomor_urut" => $nomor_urut,
            "nama1" => $nama1,
            "nama2" => $nama2,
            "foto" => $foto,
            "vote" => $vote,
            "visi_misi" => html_entity_decode($visi_misi)
        );
        array_push($categories_arr["records"], $category_item);
    }
    http_response_code(200);
    echo json_encode($categories_arr, JSON_PRETTY_PRINT);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Not found.")
    );
}
?>