<?php
class Pilihan{
  
    // database connection and table name
    private $conn;
    private $table_name = "pilihan";
  
    // object properties
    public $nim;
    public $nomor_urut;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read one
    function readOne(){
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE nim = ? LIMIT 0,1";
      
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
      
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
      
        // execute query
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row != null){
            // set values to object properties
            $this->nim = $row['nim'];
        } else {
            $message = "Tidak ditemukan";
        }
        
    }
    // ./read one

    function insert(){
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nim=:nim, nomor_urut=:nomor_urut";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nim=htmlspecialchars(strip_tags($this->nim));
        $this->nomor_urut=htmlspecialchars(strip_tags($this->nomor_urut));
    
        // bind values
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":nomor_urut", $this->nomor_urut);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
  
    return false;     
    }
}
?>