<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/pilihan.php';
include_once '../objects/calon.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare object
$pilihan = new Pilihan($db);

$calon = new Calon($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$pilihan->nomor_urut = $data->nomor_urut;
$pilihan->nim = $data->nim;
$calon->nomor_urut = $data->nomor_urut;
$calon->vote = $data->vote;
    # nim, nomor_urut insert ke tabel pilihan
    # vote update ke tabel calon
// set product property values


  
// update the product
if($calon->update()){
    if($pilihan->insert()){
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Success updated."));
    } else{
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the user
        echo json_encode(array("message" => "Failed."));
    }
}
?>