<?php
	if(!empty($_POST)){
		extract($_POST);
		$user = mysqli_real_escape_string($kon, $_POST['user']);
		$pa = mysqli_real_escape_string($kon, $_POST['pass']);
		$pas = md5($pa);
		$pass = sha1($pas);
		$query = mysqli_query($kon, "SELECT * FROM admin where username = '$user'")or die(mysqli_error($kon));
        $jmlh = mysqli_num_rows($query);
        
		if($jmlh < 1){        
			echo "<div class='alert alert-danger panelpil'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  		<strong>Username</strong> belum terdaftar atau tidak tersedia.
	</div>";
        } else {
            $hasil = mysqli_fetch_array($query);
            $pass_benar = $hasil['password'];
            if($pass != $pass_benar){
                    echo "<div class='alert alert-danger panelpil'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Password </strong> kamu salah, coba lagi.
            </div>";
                }
		else{
			$_SESSION['admin'] = $user;
			header("location:admin/index.php");
		}
	}
    }
?>