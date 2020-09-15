<?php
class Calon{
  
    // database connection and table name
    private $conn;
    private $table_name = "calon";
  
    // object properties
    public $id;
    public $nomor_urut;
    public $nama1;
    public $nama2;
    public $foto;
    public $visi_misi;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    public function read(){
        //select all data
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nomor_urut";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
}
