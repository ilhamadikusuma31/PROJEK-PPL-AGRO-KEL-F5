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
    <title>Halaman Registrasi</title>
</head>
<body>
    <form action="" method="post">
        <ul>
            <li>
                <label for="uname">username</label>
                <input type="text" name="uname" id="uname">
            </li>
            <li>
                <label for="pass">password</label>
                <input type="password" name="pass" id="pass">
            </li>
            <li>
                <label for="pass2">konfirmasi password</label>
                <input type="password" name="pass2" id="pass2">
            </li>
            <li>
                <button type="submit" name="regis">Register</button>
            </li>
        </ul>
    </form>
    
</body>
</html>