<?php
function alert($alert){
		echo "<script type='text/javascript'>
			alert('".$alert."');
			</script>";
	}
	function redir($redir){
		echo "<script type='text/javascript'>
			document.location='".$redir."';
			</script>";
    }
    include "../../api/config/database.php";
    include "../cek-admin.php";
    
    if ($_FILES['file']['type'] == "application/vnd.ms-excel") {
        include "excel_reader.php";
        
        $data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);
        $baris = $data->rowcount($sheet_index=0);
        $sukses = 0;
        $gagal = 0;
        for ($i=2; $i<=$baris; $i++) {
            $nim = $data->val($i, 1);
            $nama = $data->val($i, 2);
            $kelas = $data->val($i, 3);
            $query = "INSERT INTO pemilih (nim,nama,kelas) VALUES ('$nim', '$nama', '$kelas')";
            $hasil = mysqli_query($kon, $query);
            if ($hasil) $sukses++;
            else $gagal++;
            }
            alert('Import data berhasil!');
            redir('data-pemilih.php');
        } else {
            alert('Bukan formulir .xls!');
            redir('data-pemilih.php');
    }

?>