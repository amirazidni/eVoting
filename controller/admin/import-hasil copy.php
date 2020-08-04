<html>
    <head>
    <meta charset="utf-8">
    <title>CryptoJS Example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
    </head>
        <body>  
<?php
/*******EDIT LINES 3-8*******/
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "root"; //MySQL Username     
$DB_Password = "";             //MySQL Password     
$DB_DBName = "eVoting";         //MySQL Database Name  
$DB_TBLName = "calon"; //MySQL Table Name   
$filename = "Hasil_suara";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "Select * from $DB_TBLName";
$Connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password,$DB_DBName) or die("Couldn't connect to MySQL:<br>" . mysqli_error() . "<br>" . mysqli_errno());
//select database     
//execute query 
$result = @mysqli_query($Connect,$sql) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_errno());    
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
// for ($i = 0; $i < mysqli_num_fields($result); $i++) {
//     echo (mysqli_field_name($result,$i) . "\t");
// }


while ($property = mysqli_fetch_field($result)) {
    switch($property->name){
        case 'nomor_urut':
            echo "Nomor Urut". "\t";
		    break;
		case 'nama1': 
		    echo "Ketua". "\t"; 
		    break;
		case 'nama2': 
		    echo "Wakil Ketua". "\t"; 
		    break;
		case 'vote':
		    echo "Perolehan Suara". "\t";
		    break;
	}

}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_row($result))
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
        print(trim($schema_insert));
        print "\n";
    }

?>
</body>
</html>