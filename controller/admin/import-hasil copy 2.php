<?php
use Nullix\CryptoJsAes\CryptoJsAes;

require "CryptoJsAes.php";
require "../cek-admin.php";

/*******EDIT LINES 3-8*******/
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "root"; //MySQL Username     
$DB_Password = "";             //MySQL Password     
$DB_DBName = "evoting";         //MySQL Database Name  
$DB_TBLName = "calon"; //MySQL Table Name   
$filename = "hasil_rekap";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "Select * from $DB_TBLName ORDER BY vote DESC";
$Connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password,$DB_DBName) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   

$result = @mysqli_query($Connect,$sql) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = "xls";

//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");

/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields

$pwd = "111";
while ($property = mysqli_fetch_field($result)) {
    if($property->name == "nomor_urut"){
        $pesan = "Nomor Urut";
    } elseif($property->name == "nama1"){
        $pesan = "Ketua";
    } elseif($property->name == "nama2"){
        $pesan = "Wakil Ketua";
    } elseif($property->name == "vote"){
        $pesan = "Perolehan Suara";
    } else {
        $pesan = "";
    }
    if ($pesan != "") {
        $cipher = CryptoJsAes::encrypt($pesan, $pwd);
        echo $pesan. "\t";
    }
}

print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_array($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if($j == 0 || $j == 4 || $j == 5){
                continue;
            } else {
                if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
                elseif ($row[$j] != "")
                    $schema_insert .= "$row[$j]".$sep;
                else
                    $schema_insert .= "".$sep;
            }
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        $pesan = trim($schema_insert);
        // $cipher = CryptoJsAes::encrypt($pesan, $pwd);
        print($pesan);
        print "\n";
    }

?>