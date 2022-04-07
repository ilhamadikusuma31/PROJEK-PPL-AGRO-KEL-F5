<?php 

session_start();

//kalo sesi admin tidak ada, di redirect ke halaman login
if(!isset($_SESSION["admin_login"])){
  header("location: login.php");
  exit;
}

require "../function.php";

$barang = getData("SELECT * FROM barang");
$angka = 1;


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <!-- Bootsrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />

    <!-- MY CSS  -->
    <link rel="stylesheet" href="css/style.css" />

    <title>Admin</title>
  </head>
  <body>

    <!-- Barang -->
    <a href="logout.php"><button type="button" class="btn btn-warning">Logout</button></a>
    <section class="barang container justify-content-center">
      <a href="tambah_barang.php"> <button type="button" class="btn btn-info">Tambah</button></a>
      <h4 class="text-center">Daftar Barang</h4>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Edit</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Berat(gr)</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($barang as $b): ?>
          <tr>
            <!-- logic -->
            <!-- nb: khusus jenis barang harus dicari berdasarkan id baru dapet nama_jenis_barang -->
            <?php $jenis_barang = $b['jenis_barang_id']; $jenis_barang = getData("SELECT nama_jenis_barang FROM jenis_barang WHERE jenis_barang_id = $jenis_barang ")[0]['nama_jenis_barang']?>
            <!-- main -->
            <td><?= $angka++ ?></td>
            <td>
              <a href="ubah_barang.php?id=<?= $b['barang_id']  ?>"><button type="button" class="btn btn-warning">modif</button></a>
              <a href="hapus_barang.php?id=<?= $b['barang_id']  ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><button type="button" class="btn btn-danger mt-1">hapus</button></a>
            </td>
            <td><img src="../img/<?= $b['foto_barang']  ?>" width="150px" /></td>
            <td><?= $b['nama_barang']  ?></td>
            <td><?= $jenis_barang  ?></td>
            <td><?= $b['berat_barang']  ?></td>
            <td><?= $b['harga_barang']  ?></td>
            <!-- akhir main -->
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </section>
    <!-- Akhir Barang -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>

<script>
  $(document).ready(function () {
    $(".table").DataTable();
  });
</script>