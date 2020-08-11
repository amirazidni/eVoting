<!DOCTYPE html>
<html>
<head>
<title>Forbidden</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
</head>
<body>
<?php
    include "../cek-admin.php";
    if(!empty(isset($_POST))) {
        $pass = $_POST['pass'];
        if (($fp = fopen($_FILES["file"]["tmp_name"], "r")) !== FALSE) {
            $json = array();
            while (($row = fgetcsv($fp)) !== false) {
                $baris =  array(
                    "nomor_urut" => $row[0],
                    "nama" => $row[1],
                    "vote" => $row[2],
                );
                array_push($json, ($baris));
            
            }
            // echo "<pre>";
            json_encode(array("result" => $json), JSON_PRETTY_PRINT);
            // echo "</pre>";
            fclose($fp);
        }
        
    } else {
        alert('Password / file belum diinput');
        header('location:rekapitulasi.php');
    }
?>
    <script type="text/javascript" src="../../plugins/jquery/jquery.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            getData();
            
        });

        function getData() {  
            var data = <?php echo json_encode(array("result" => $json), JSON_PRETTY_PRINT) ?>;
            var pass = <?php echo json_encode(($pass), JSON_PRETTY_PRINT); ?>;
            
            var nomor = [];
            var nama = [];
            var vote = [];
            var trim_nomor, trim_nama, trim_vote;
            var decrypted_nomor,decrypted_nama,decrypted_vote;
            $.each(data.result, function() {
                // CLEANING
                trim_nomor = this['nomor_urut'].trim();
                trim_nama = this['nama'].trim();
                trim_vote = this['vote'].trim();

                //DECRYPTING
                decrypted_nomor = CryptoJS.AES.decrypt(trim_nomor, pass).toString(CryptoJS.enc.Utf8);
                decrypted_nama = CryptoJS.AES.decrypt(trim_nama, pass).toString(CryptoJS.enc.Utf8);
                decrypted_vote = CryptoJS.AES.decrypt(trim_vote, pass).toString(CryptoJS.enc.Utf8);

                //PUSH 
                nomor.push(decrypted_nomor);
                nama.push(decrypted_nama);
                vote.push(decrypted_vote);

            })
            var Results = [];
            for (i = 0; i < nomor.length; i++) {
                Results.push([nomor[i]+", "+ nama[i]+", "+ vote[i]])
            }
                var CsvString = "";
                Results.forEach(function(RowItem, RowIndex) {
                RowItem.forEach(function(ColItem, ColIndex) {
                    CsvString += ColItem + ',';
                });
                CsvString += "\r\n";
                });
                CsvString = "data:application/csv," + encodeURIComponent(CsvString);
                var x = document.createElement("A");
                x.setAttribute("href", CsvString );
                x.setAttribute("download","Hasil Perhitungan Terdekripsi.csv");
                document.body.appendChild(x);
                x.click();
                document.location='rekapitulasi.php';

            
        }

    </script>
</body>
</html>