<?php 

session_start();

//kalo sesi admin tidak ada, di redirect ke halaman login
if(!isset($_SESSION["admin_login"])){
  header("location: login.php");
  exit;
}

require "../function.php";


// jika tombol submit sudah ditekan
if  (isset($_POST["sbmt"])){
    //memanggil fungsi yang ada di function.php
    //nb: $_POST adalah sebuah array yang berisi nilai dari tag Form berdasarkan attribute name di tag input
    addDataBarang($_POST);
    
}

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

<div class="container-fluid">
<!-- Form untuk modif -->
<!-- nb: kasih att name di tag input agar bisa dikirimkan datanya -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
    </div>
    <div class="card-body">
        <!-- multipart/form-data : agar file foto bisa diup ke dir -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- <div class="row mb-1">
                <div class="col-md-2">Foto</div>
                <div class="col">
                    <img src="img/<?= $barangs['foto_barang'];?>" width="200px" alt="">
                </div>
            </div> -->
            <div class="row mb-1">
                <div class="col-md-2">Foto</div>
                <div class="col-md-5"><div class="form-group">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto_brg" Required>
                </div></div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">Nama Barang</div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" id="formGroupExampleInput" name="nama_brg" Required>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    Jenis Barang
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_brg" Required>
                        <?php $j_brg = getData("SELECT * FROM jenis_barang")?>
                        <?php for($i = 0; $i< count($j_brg); $i++): ?>
                        <option><?=($j_brg[$i]['nama_jenis_barang']) ?></option>
                        <?php endfor ?>
                    </select>
                    </div>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-2">
                    Berat Barang
                </div>
                <div class="col-md-5">
                    <div class="input-group mb-2">
                        <input type="number" min=0 class="form-control" id="inlineFormInputGroup" placeholder="" name="berat_brg" Required>
                        <div class="input-group-append">
                            <div class="input-group-text">gram</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-2">
                    Harga Barang
                </div>
                <div class="col-md-5">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="" name="harga_brg" Required>
                        <div class="input-group-append">
                            <div class="input-group-text">,00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-beetween">
                <div class="col mb-1"><button class="btn btn-danger" type="" onclick="location.href = 'index.php';">Kembali</button></div>
                <div class="col mb-1"><button class="btn btn-primary" type="submit" name="sbmt" onclick="return confirm('Apakah Anda yakin ingin menambah barang ini?')">Submit</button></div>
            </div>
        </form>
    </div>
</div>

</div>    
<!-- /.container-fluid -->

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