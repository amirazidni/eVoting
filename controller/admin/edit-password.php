<?php
	if(!empty($_POST)){
		extract($_POST);
		$pa = mysqli_real_escape_string($kon, $_POST['passLama']);
        $pa2 = mysqli_real_escape_string($kon, $_POST['passBaru']);
        
		$pas = md5($pa);
        $pass = sha1($pas);
        $pas2 = md5($pa2);
        $pass2 = sha1($pas2);
        
        $query = mysqli_query($kon, "SELECT * FROM admin where username = '".$_SESSION['admin']."'")or die(mysqli_error($kon));
        $hasil = mysqli_fetch_array($query);
        $pass_benar = $hasil['password'];

        if($pass != $pass_benar){
            echo "<div class='alert alert-danger panelpil'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Password </strong> kamu salah, coba lagi.
                </div>";
        } else {
            $query = mysqli_query($kon, "UPDATE admin SET password = '".$pass2."' WHERE username = '".$_SESSION['admin']."'")or die(mysqli_error($kon));
            $jmlh = mysqli_affected_rows($kon);
            
            if($jmlh == 1){  
            echo "<div class='alert alert-success panelpil'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Password</strong> berhasil diganti.
            </div>";
            }
        }
		
	}
    
?>