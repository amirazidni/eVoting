<?php
// use Nullix\CryptoJsAes\CryptoJsAes;

// require "CryptoJsAes.php";
// require "../cek-admin.php";

/*******EDIT LINES 3-8*******/
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "root"; //MySQL Username     
$DB_Password = "";             //MySQL Password     
$DB_DBName = "evoting";         //MySQL Database Name  
$DB_TBLName = "calon"; //MySQL Table Name   
$filename = "hasil_rekap";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "Select nomor_urut, nama1, nama2, vote from $DB_TBLName ORDER BY vote DESC";
$Connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password,$DB_DBName) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   

$result = @mysqli_query($Connect,$sql) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    

$users = array();
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
// echo "<pre>";
echo json_encode(array("result" => $users), JSON_PRETTY_PRINT);
// echo "</pre>";
?>