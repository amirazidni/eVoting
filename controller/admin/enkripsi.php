<!DOCTYPE html>
<html>
<head>
<?php
    include "../../api/config/database.php";
    include "../cek-admin.php";
    if(!empty(isset($_POST['pass']))) {
        $pass = $_POST['pass'];
    } else {
        alert('Password kosong! Isi dulu password sebelum mengunduh.');
        header('location:rekapitulasi.php');
    }
?>
    <title>Forbidden</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
</head>
    <script type="text/javascript" src="../../plugins/jquery/jquery.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
            getData();
        });

    function getData() {
        $.getJSON("import-hasil.php", function(data) {
            var pass = <?php echo json_encode(($pass), JSON_PRETTY_PRINT); ?>;
            var nomor = [];
            var nama = [];
            var vote = [];
            $.each(data.result, function() {
                nomor.push(CryptoJS.AES.encrypt(this['nomor_urut'], pass));
                nama.push(CryptoJS.AES.encrypt(this['nama1']+" - "+this['nama2'], pass));
                vote.push(CryptoJS.AES.encrypt(this['vote'], pass));
            })

            var Results = [[CryptoJS.AES.encrypt("Nomor", pass), CryptoJS.AES.encrypt("Nama Paslon", pass), CryptoJS.AES.encrypt("Suara Masuk", pass)]];

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
                x.setAttribute("download","Hasil Perhitungan Terenkripsi.csv");
                document.body.appendChild(x);
                x.click();
                
    });

    }

    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        document.location='rekapitulasi.php';
    });
    </script>
</body>
</html>