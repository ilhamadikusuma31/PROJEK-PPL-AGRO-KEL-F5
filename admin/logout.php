<?php 
session_start();

//menghapus sesi
$_SESSION=[];
session_unset();
session_destroy();

//menghapus cookie
setcookie('kami','',time()-3600);
setcookie('kaze','',time()-3600);

//redireect ke halaman login
header("location: login.php")

?>