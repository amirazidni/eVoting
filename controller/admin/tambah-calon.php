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

$no		    = $_POST['no'];
$nama1		= $_POST['nama1'];
$nama2		= $_POST['nama2'];
$visimisi	= $_POST['visimisi'];
$namafile	= $_FILES['foto']['name'];
$namafile2	= strtolower("calon-".$nama."-".$namafile);
$fileSize	= $_FILES['foto']['size'];  
$fileError	= $_FILES['foto']['error'];

if($fileSize > 0 || $fileError == 0){  

	$move = move_uploaded_file($_FILES['foto']['tmp_name'], '../../build/img/upload/'.$namafile2);  
	if($move){  
		mysqli_query($kon, "INSERT INTO calon (nomor_urut,nama1,nama2,foto,visi_misi) values ('$no','$nama1','$nama2','$namafile2','$visimisi')");
		alert('Data berhasil disimpan.');
		redir('data-calon.php?#section2');
	}else{  
		echo "Gagal menyimpan";
		echo "<a href=data-calon.php>Kembali</a>";
	}  
	}else{  
		echo "Gagal menyimpan foto ".$fileError;
		echo "<a href=data-calon.php>Kembali</a>";
	} 
?>