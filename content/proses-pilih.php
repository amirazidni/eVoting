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

include_once "cek-pemilih.php";
$nim = $_SESSION['pemilih'];

include_once "../api/read-pilihan.php";
include_once "../api/read-calon.php";

$pilihan = $_GET['nomor'];
foreach ($data['records'] as $calon){
    if ($calon['nomor_urut'] == $pilihan){
        $jumlah_vote = $calon['vote'];
    }
}

$total_vote = ($jumlah_vote+1);

	if (@!isset($data_pilihan['message'])) {
		alert('Suara sudah digunakan!');
		 redir('login.php');
	} else {
		include_once "../api/update-hasil.php";
		 alert('Sukses, selamat ya!');
		 unset($_SESSION['pemilih']);
		 redir('login.php');
	}
?>