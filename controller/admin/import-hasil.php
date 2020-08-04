<html>
    <head>
    <meta charset="utf-8">
    <title>CryptoJS Example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    <script type="text/javascript">
        var myPass = "AHA";
        function enkripsi(pesan){
            var cipher = CryptoJS.AES.encrypt(pesan, myPass);
            
            document.getElementById("pesan").innerHTML = cipher;
            alert(cipher);
            return cipher;
        }
        
    </script>
    
    </head>
        <body>  
<?php
/*******EDIT LINES 3-8*******/
require_once "../../api/config/database.php"; 
$filename = "hasil-suara";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   

 
//execute query 
$query = mysqli_query($kon, "SELECT * FROM calon order by vote ASC")or die(mysqli_error($kon));
while($row = mysqli_fetch_row($query))
{
    echo $row['id'];
}

$file_ending = "xls";

//header info for browser
// header("Content-Type: application/xls");    
// header("Content-Disposition: attachment; filename=$filename.xls");  
// header("Pragma: no-cache"); 
// header("Expires: 0");

/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
// for ($i = 0; $i < mysqli_num_fields($query); $i++) {
//     echo (mysqli_field_name($query,$i) . "\t");
// }

$json = array();
while ($property = mysqli_fetch_field($query)) {
    switch($property->name){
        case 'nomor_urut':
            $query = array_push($json, "Nomor Urut");
            echo "Nomor Urut". "\t";
		    break;
        case 'nama1': 
            $query = array_push($json, "Ketua");
		    echo "Ketua". "\t"; 
		    break;
        case 'nama2': 
            $query = array_push($json, "Wakil Ketua");
		    echo "Wakil Ketua". "\t"; 
		    break;
        case 'vote':
            $query = array_push($json, "Perolehan Suara");
		    echo "Perolehan Suara". "\t";
		    break;
	}

}
print("\n");    
print_r($json);    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_row($query))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($query);$j++)
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
        print(trim($schema_insert));
        print "\n";
    }

?>
</body>
</html>