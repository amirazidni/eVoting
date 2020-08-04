<?php
    include "../../api/config/database.php";
    include "../cek-admin.php";
	
	$id = $_GET['no'];
	$query=mysqli_query($kon, "DELETE FROM calon where id = '$id'")or die(mysqli_error($kon));
	if($query){
		echo "<script>
		alert('SUKSES MENGHAPUS!');
		</script>";
		header('location:data-calon.php');
	}
	else{
		echo "<script>
		alert('GAGAL MENGHAPUS !');
		</script>";
		header('location:data-calon.php');
	}

?>