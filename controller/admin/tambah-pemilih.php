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
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];

	$perintah1 = mysqli_query($kon, "SELECT * FROM pemilih WHERE nim='$nim'");
	$jumlah = mysqli_num_rows( $perintah1);
	if ($jumlah>=1) {
		alert('Gagal! NIM sudah dipakai :(');
		redir('data-pemilih.php');
	} else {
		mysqli_query($kon, "INSERT INTO pemilih (nim,nama,kelas) VALUES ('$nim','$nama','$kelas')");
		alert('Berhasil!');
		redir('data-pemilih.php');
		
	}
?>