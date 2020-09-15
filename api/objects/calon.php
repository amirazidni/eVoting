<?php
class Calon{
    private $conn;
    private $table_name = "calon";
  
    public $id;
    public $nomor_urut;
    public $nama1;
    public $nama2;
    public $foto;
    public $visi_misi;
    public $vote;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    public function read(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nomor_urut";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }

    function update(){
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        vote = :vote
                    WHERE
                        nomor_urut = :nomor_urut";
        
            $stmt = $this->conn->prepare($query);
            $this->nomor_urut=htmlspecialchars(strip_tags($this->nomor_urut));
            $this->vote=htmlspecialchars(strip_tags($this->vote));
            $stmt->bindParam(':nomor_urut', $this->nomor_urut);
            $stmt->bindParam(':vote', $this->vote);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        // ./update
}
?>