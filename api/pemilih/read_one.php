<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/pemilih.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Pemilih($db);
  
// set ID property of record to read
$product->id = isset($_GET['nim']) ? $_GET['nim'] : die();
  
// read the details of product to be edited
$product->readOne();
  
if($product->nim != null){
    // create array
    $product_arr = array(
        "nim" => $product->nim,
        "nama" => $product->nama,
        "kelas" => $product->kelas,
        "nomor_urut" => $product->nomor_urut,
        "status" => $product->status
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
} else {
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Pemilih tidak terdaftar."));
}
?>