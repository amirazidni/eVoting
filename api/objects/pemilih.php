<?php
class Pemilih{
    private $conn;
    private $table_name = "pemilih";
    public $id;
    public $nim;
    public $nama;
    public $kelas;
    public $nomor_urut;
    public $status;
  
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
            $this->nama = $row['nama'];
            $this->kelas = $row['kelas'];
            $this->nomor_urut = $row['nomor_urut'];
            $this->status = $row['status'];
        } else {
            $message = "Pemilih tidak terdaftar";
        }
    }
    // ./read one

    // update the product
    function update(){
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    description = :description,
                    category_id = :category_id
                WHERE
                    id = :id";
        $stmt = $this->conn->prepare($query);
    
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    // ./update
}
?>