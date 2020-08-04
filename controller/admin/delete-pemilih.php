<?php
include "../../api/config/database.php";
include "../cek-admin.php";
	
	$nim = $_GET['nim'];
	$query = mysqli_query($kon, "DELETE FROM pemilih where nim = '$nim'") or die (mysqli_error($kon)) ;
	if ($query){
		echo "<script>
		alert('SUKSES MENGHAPUS !');
		</script>";
		header('location:data-pemilih.php');
	}
	else{
		echo "<script>
		alert('GAGAL MENGHAPUS !');
		</script>";
		header('location:data-pemilih.php');
	}
	
?>