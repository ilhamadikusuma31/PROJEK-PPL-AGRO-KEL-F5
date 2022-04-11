<?php 
session_start();

//kalo sesi admin tidak ada, di redirect ke halaman login
if(!isset($_SESSION["admin_login"])){
  header("location: login.php");
  exit;
}

require '../function.php';
$id = $_GET["id"];

//butuh namafilegambar agar nanti bisa dihapus foto nya dari dir
$namaFileGambar = getData("SELECT foto_barang FROM barang WHERE barang_id = $id ")[0]["foto_barang"];

$cek = deleteDataBarang($id,$namaFileGambar);

//cek berhasil dihapus atau tidak

if($cek > 0 ){
    echo "
    <script> 
    alert('data berhasil dihapus');
    document.location.href = 'admin_kelola_barang.php';
    </script>";
}

else{
    echo "
    <script> 
    alert('data gagal dihapus');
    </script>";
}

?>
