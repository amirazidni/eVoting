<?php
	session_start();
	if(!empty($_POST)){
        extract($_POST);
		include_once "../api/read-one.php";
		if(@isset($data['message'])){
			echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'> &times; </a>
						NIM tidak terdaftar.
					</div>";
		}
		elseif($data['nomor_urut'] > 0){
			echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'> &times; </a>
						Suara sudah digunakan.
					</div>";
		}
		elseif($data['status'] == 0){
			echo "<div class='alert alert-danger panelpil'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Silahkan validasi ke petugas dahulu.
					</div>";
		} else{
			$_SESSION['pemilih'] = $data['nim'];
			$_SESSION['nama'] = $data['nama'];
			header("location:pemilihan.php");
		}
	}

?>