<?php 

require '../function.php';

if(isset($_POST['regis'])){
    registration($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Gemol Indonesia</title>
	<!-- / Bootstrap Core -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- / FontAwesome -->
	<link rel="stylesheet" type="text/css" href="../font/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- / Custom style -->
	<link rel="stylesheet" type="text/css" href="../css/styleLoginSignUpAdmin.css">
	<title>Halaman Login</title>
</head>

<body>
	<main>
		<div class="form-main-container">
			<div class="form-wrapper">
				<div class="form-header">
					<span class="form-title">
						Daftar <strong>Gemol Indonesia</strong>
					</span>
				</div>

				<form class="form-content" method="POST">
					<div class="input-wrapper">
						<input class="input-style" type="text" name="uname" placeholder="Username" id="username"
							autocomplete="off" required>
						<span class="input-style-focus"></span>
					</div>

					<div class="input-wrapper">
						<div class="input-group">
							<input class="form-control" type="password" placeholder="Password" id="password" name="pass"
								autocomplete="off" required>
							<span class="form-control-focus"></span>
							<div class="input-group-addon" onclick="passwordVisibility();">
								<i class="fa fa-eye" id="showPass"></i>
								<i class="fa fa-eye-slash d-none" id="hidePass"></i>
							</div>
						</div>
					</div>
					<div class="input-wrapper">
						<div class="input-group">
							<input class="form-control" type="password" placeholder="Konfirmasi Password" id="password"
								name="pass2" autocomplete="off" required>
							<span class="form-control-focus"></span>
							<div class="input-group-addon" onclick="passwordVisibility();">
								<i class="fa fa-eye" id="showPass"></i>
								<i class="fa fa-eye-slash d-none" id="hidePass"></i>
							</div>
						</div>
					</div>

					<button class="button-style w-100" name="regis">
						daftar
					</button>


				</form>
			</div>
		</div>
	</main>


	<script src="../js/password-visibility.js"></script>
</body>

</html>