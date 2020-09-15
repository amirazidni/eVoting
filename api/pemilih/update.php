<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../objects/pilihan.php';
include_once '../objects/calon.php';
  
$database = new Database();
$db = $database->getConnection();
$pilihan = new Pilihan($db);
$calon = new Calon($db);
$data = json_decode(file_get_contents("php://input"));
$pilihan->nomor_urut = $data->nomor_urut;
$pilihan->nim = $data->nim;
$calon->nomor_urut = $data->nomor_urut;
$calon->vote = $data->vote;
    # nim, nomor_urut insert ke tabel pilihan
    # vote update ke tabel calon
if($calon->update()){
    if($pilihan->insert()){
        http_response_code(200);
        echo json_encode(array("message" => "Berhasil diupdate."));
    } else{
        http_response_code(503);
        echo json_encode(array("message" => "Gagal..."));
    }
}
?>