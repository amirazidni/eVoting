<?php
class Pemilih{
  
    // database connection and table name
    private $conn;
    private $table_name = "pemilih";
  
    // object properties
    public $id;
    public $nim;
    public $nama;
    public $password;
    public $nomor_urut;
    public $status;
  
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
            $this->nama = $row['nama'];
            $this->password = $row['password'];
            $this->nomor_urut = $row['nomor_urut'];
            $this->status = $row['status'];
        } else {
            $message = "Pemilih tidak terdaftar";
        }
        
    }
    // ./read one

    // update the product
    function update(){
    // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    description = :description,
                    category_id = :category_id
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }
    // ./update
}
