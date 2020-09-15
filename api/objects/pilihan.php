<?php
class Pilihan{
    private $conn;
    private $table_name = "pilihan";
    public $nim;
    public $nomor_urut;
    public function __construct($db){
        $this->conn = $db;
    }

    // read one
    function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE nim = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row != null){
            $this->nim = $row['nim'];
        } else {
            $message = "Tidak ditemukan";
        }
        
    }
    // ./read one

    function insert(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nim=:nim, nomor_urut=:nomor_urut";
        $stmt = $this->conn->prepare($query);
    
        $this->nim=htmlspecialchars(strip_tags($this->nim));
        $this->nomor_urut=htmlspecialchars(strip_tags($this->nomor_urut));
    
        $stmt->bindParam(":nim", $this->nim);
        $stmt->bindParam(":nomor_urut", $this->nomor_urut);
    
        if($stmt->execute()){        
            return true;
        }
  
    return false;     
    }
}
?>