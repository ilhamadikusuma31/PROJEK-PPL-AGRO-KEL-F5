<?php 
session_start();
require '../../function.php';

//kalo sesi admin tidak ada, di redirect ke halaman login
if(!isset($_SESSION["admin_login"])){
  header("location: login.php");
  exit;
}

$path_brg = "barang.php";

$id = $_GET["id"];

//butuh namafilegambar agar nanti bisa dihapus foto nya dari dir
$namaFileGambar = getData("SELECT foto_barang FROM barang WHERE barang_id = $id ")[0]["foto_barang"];

$cek = deleteDataBarang($id,$namaFileGambar);

//cek berhasil dihapus atau tidak
if($cek > 0 ){
    echo "
    <script> 
    alert('data berhasil dihapus');
    document.location.href = '$path_brg';
    </script>";
}

else{
    echo "
    <script> 
    alert('data gagal dihapus');
    </script>";
}

?>

