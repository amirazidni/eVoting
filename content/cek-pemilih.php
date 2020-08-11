<?php
	session_start();
	if(!isset($_SESSION['pemilih'])){
		header("location:login.php");
	}
?>