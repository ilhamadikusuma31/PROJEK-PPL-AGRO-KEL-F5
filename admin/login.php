<?php 
session_start(); // agar bisa mengset sesi

require '../function.php';


//cek cookie: //kami == uname, kaze == id 
if (isset($_COOKIE['kaze']) and isset(($_COOKIE['kami']))){
    $kami= $_COOKIE['kami'];
    $kaze = $_COOKIE['kaze'];

    //ambil uname berdasarkan kaze == id
    $hasil = mysqli_query($conn, "SELECT username FROM admin WHERE admin_id = '$kaze'");
    $row = mysqli_fetch_assoc($hasil);


    //apakah cocok cookie uname dengan uname yang ada di db  
    if($kami=== hash("sha256",$row["username"])){
        $_SESSION['admin_login'] = true;
        
    }
}

//kalo sesi admin sudah ada, di redirect ke halaman index
if(isset($_SESSION["admin_login"])){
    header("location: index.php");
    exit;
}



if(isset($_POST['sbmt'])){
    $uname = $_POST['username'];
    $pw = $_POST['password'];
    $hasil = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$uname'");

    //cek username
    if(mysqli_num_rows($hasil) === 1){

        //cek password
        $row = mysqli_fetch_assoc($hasil);

       
        if(password_verify($pw, $row['password'])){
            
            //set session 
            $_SESSION['admin_login'] = true;


            //cek remember me
            if(isset($_POST['ingatSaya'])){
                //buat cookie nya, setcookie(key, value, berapaLama) => $_COOKIE['key'] =  value 
                // setcookie('admin_login','True',time()+3600); //ini kurang aman karena langung set cookie
                // kaze == id, kami == uname
                setcookie('kaze',$row['admin_id'],time()+60);
                setcookie('kami',hash("sha256",$row['username']),time()+60);
                
            }

            $_SESSION['nama_admin'] = $row['username'];
            header("location: index.php");
            exit;
        }
    }

    $error = true;

}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/login.ico" />

	<!-- / Bootstrap Core -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- / FontAwesome -->
	<link rel="stylesheet" type="text/css" href="../font/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- / Custom style -->
	<link rel="stylesheet" type="text/css" href="../css/styleLoginSignUpAdmin.css">
    <link rel="shortcut icon" href="../img/Logo Mitra_lingkaran.png">
    <title>Admin | Gemol Indonesia </title>
</head>
<body>
    <main>
	    <div class="form-main-container">
		    <div class="form-wrapper">
				<div class="form-header">
					<span class="form-title">
						Login <strong>Gemol Indonesia</strong>
					</span>
				</div>

				<form class="form-content" method="POST">
					<div class="input-wrapper">
						<input class="input-style" type="text" name="username" placeholder="Username" id="username" autocomplete="off" required>
						<span class="input-style-focus"></span>
					</div>

					<div class="input-wrapper">
						<div class="input-group">
							<input class="form-control" type="password" placeholder="Password" id="password1" name="password" autocomplete="off" required>
							<span class="form-control-focus"></span>
							<div class="input-group-addon" onclick="passwordVisibility(1);">
								<i class="fa fa-eye" id="showPass1"></i>
								<i class="fa fa-eye-slash d-none" id="hidePass1"></i>
							</div>
						</div>
					</div>

					<button class="button-style w-100" name="sbmt">
						Login
					</button>

					<div class="checkbox-wrapper mt-4">
						<input type="checkbox" class="checkbox-style" id="checkbox" name="ingatSaya">
						<label class="label-checkbox-style" for="checkbox">
							Remember me
						</label>
					</div>

				</form>
			</div>
		</div>
	</main>

    <script src="../js/password-visibility.js"></script>
</body>
</html>