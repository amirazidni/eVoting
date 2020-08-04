<?php
    include "../../api/config/database.php";
    include "../cek-admin.php";
  mysqli_query($kon, "Select * from pilihan");
   mysqli_query($kon, "Truncate pilihan");
	
	mysqli_query($kon, "select * from calon");
	mysqli_query($kon, "update calon set vote = 0") or die(mysqli_error($kon));
	header("location:rekapitulasi.php");
	
  ?>