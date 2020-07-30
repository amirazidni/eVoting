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
    public $vote;
  
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

    function update(){
        // update query
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        vote = :vote
                    WHERE
                        nomor_urut = :nomor_urut";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // sanitize
            $this->nomor_urut=htmlspecialchars(strip_tags($this->nomor_urut));
            $this->vote=htmlspecialchars(strip_tags($this->vote));
        
            // bind new values
            $stmt->bindParam(':nomor_urut', $this->nomor_urut);
            $stmt->bindParam(':vote', $this->vote);
        
            // execute the query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }
        // ./update
}
?>