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
    var_dump($row[0]);

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
    <title>Halaman Login</title>
</head>
<body>
    <h1>halaman login</h1>
    <?php if(isset($error)): ?>
        <h6>Username atau Password salah</h6>
    <?php endif ?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username:</label>
                <input type="text" name="username" id ="username">
            </li>
            <li>
                <label for="password">password:</label>
                <input type="text" name="password" id ="password">
            </li>
            <li>
                <input type="checkbox" name="ingatSaya" id ="ingatSaya">
                <label for="password">ingat saya</label>
            </li>
            <li>
                <button type="submit" name="sbmt">Login</button>
            </li>
        </ul>
    </form>
</body>
</html>