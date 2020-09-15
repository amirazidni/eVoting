<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/pemilih.php';
  
$database = new Database();
$db = $database->getConnection();
$product = new Pemilih($db);
$product->id = isset($_GET['nim']) ? $_GET['nim'] : die();
$product->readOne();
  
if($product->nim != null){
    $product_arr = array(
        "nim" => $product->nim,
        "nama" => $product->nama,
        "kelas" => $product->kelas,
        "nomor_urut" => $product->nomor_urut,
        "status" => $product->status
    );
    http_response_code(200);
    echo json_encode($product_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Pemilih tidak terdaftar."));
}
?>