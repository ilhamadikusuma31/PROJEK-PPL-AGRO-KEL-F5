<?php 

session_start();
require "../../function.php";





$path_web_gemol    = "../index.php";
$path_login        = "../login.php";
$path_logout       = "../logout.php";
$path_registrasi   = "../registrasi.php";
$path_main         = "../index.php";
$path_img          = "../../img";
$path_vendor       = "../../vendor";
$path_css          = "../../css";
$path_js           = "../../js";



$path_brg          = "barang.php";
$path_edit_brg     = "barang_edit.php";
$path_hapus_brg    = "barang_hapus.php";
$path_tambah_brg   = "barang_tambah.php";
$path_export       = "export.php";

$path_setting_admin= "../setting_admin.php";

$path_penjualan    ="../penjualan/penjualan.php";


//kalo sesi admin tidak ada, di redirect ke halaman login
if(!isset($_SESSION["admin_login"])){
    header("location: login.php");
    exit;
}

//nama uname admin yang sekarang sedang mengakses
$uname = $_SESSION['nama_admin']; //diset di login.php


//id tergantung barang mana yang diklik
$id = $_GET["id"];

// variabel raws menyimpan semua data dari tabel barang, jenis_barang, status_barang(rekomen atau normal)
// kalo mau make datanya tinggal panggil kolomnya dari salah satu tabel tsb.
$raws = getData("SELECT *
                FROM jenis_barang
                JOIN barang on jenis_barang.jenis_barang_id = barang.jenis_barang_id
                JOIN status_barang on status_barang.status_barang_id = barang.status_barang_id 
                WHERE barang_id = $id; 
                ")[0];

//jenis barang
$jenis_brg = getData("SELECT * FROM jenis_barang");

//status
$status_brg = getData("SELECT * FROM status_barang");

// jika tombol submit sudah ditekan
if  (isset($_POST["sbmt"])){
    //memanggil fungsi yang ada di function.php
    //nb: $_POST adalah sebuah array yang berisi nilai dari tag Form berdasarkan attribute name di tag input
    $cek = updateDataBarang($_POST);
    //cek berhasil ditambahkan atau tidak apakah ada data yang nambah?
    if($cek > 0){
        echo "
        <script> 
        alert('data berhasil diubah');
        document.location.href = '$path_brg';
        </script>";
        }

    else{
        echo "
        <script> 
        alert('tidak ada yang diubah');
        </script>";
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?=$path_vendor;?>/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=$path_css;?>/style-admin.css" rel="stylesheet">
    <link href="<?=$path_css;?>/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="shortcut icon" href="<?=$path_img;?>/Logo_Mitra_lingkaran.png">





</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $path_main; ?>">
                <div class="sidebar-brand-icon">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    <img src ="<?= $path_img; ?>/Logo_Mitra_lingkaran.png" alt="" width="50%">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= $path_main; ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admin Screens:</h6>
                        <a class="collapse-item" href="<?= $path_registrasi; ?>">Register</a>
                        <a class="collapse-item" href="<?= $path_login; ?>">Login</a>
                        <a class="collapse-item" href="#">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="<?= $path_web_gemol; ?>">Website Gemol</a>
                        <!-- <a class="collapse-item" href="404.php">404 Page</a>
                        <a class="collapse-item" href="blank.php">Blank Page</a> -->
                    </div>
                </div>
            </li>
  
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Edit</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Items:</h6>
                        <a class="collapse-item" href="<?= $path_brg; ?>">barang</a>
                        <a class="collapse-item" href="#">jenis barang</a>
                        <a class="collapse-item" href="<?= $path_penjualan; ?>">penjualan</a>
                        <a class="collapse-item" href="#">ulasan</a>
                        <a class="collapse-item" href="#">testimoni</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <!-- <span class="badge badge-danger badge-counter">3+</span> -->
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <!-- <span class="badge badge-danger badge-counter">7</span> -->
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3"> 
                                        <img class="rounded-circle" src="<?= $path_img; ?>/admin/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?= $path_img; ?>/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?= $path_img; ?>/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $uname; ?></span>
                                <img class="img-profile rounded-circle"
                                    src = "<?= $path_img;?>/admin/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#popUpConfirmPW">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= $path_logout; ?>" data-toggle="modal" data-target="#popUpConfirmLogout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kelola Barang</h1>
                        <a href="<?= $path_export; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Unduh Rekap</a>
                    </div>


                    <!-- Content Row -->
                    <div class="row">
                        <div class="col mb-4">
                            <!-- Illustrations -->
                            <div class="container-fluid">
                                <!-- Form untuk modif -->
                                <!-- nb: kasih att name di tag input agar bisa dikirimkan datanya -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- multipart/form-data : agar file foto bisa diup ke dir -->
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <!-- input hidden buat ngoper id ke func updateDataBarang di function.php -->
                                            <input type="hidden" name="id_brg" value="<?= $raws["barang_id"];?>">
                                            <!-- akhir  input hidden buat ngoper id ke func updateDataBarang di function.php -->
                                            <!-- input hidden buat ngoper nama foto lama ke func updateDataBarang di function.php -->
                                            <input type="hidden" name="foto_brg_lama" value="<?= $raws["foto_barang"];?>">
                                            <!-- akhir input hidden buat ngoper nama foto lama ke func updateDataBarang di function.php -->

                                            <div class="row mb-1">
                                                <div class="col-md-2">Foto</div>
                                                <div class="col">
                                                    <img src="<?= $path_img; ?>/<?= $raws['foto_barang'];?>" width="200px" alt="">
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                            <div class="col-md-2">Upload Foto</div>
                                                <div class="col-md-5"><div class="form-group">
                                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="foto_brg" value="<?= $raws['foto_barang'];?>">
                                                </div></div>

                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-2">Nama Barang</div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="formGroupExampleInput" name="nama_brg" value="<?= $raws['nama_barang']?>" autocomplete="off" Required>
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
                                                        <?php foreach($jenis_brg as $j): ?>
                                                        <option><?=$j["nama_jenis_barang"];?></option>
                                                        <?php endforeach ?>
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
                                                        <input type="number" min=0 class="form-control" id="inlineFormInputGroup" name="berat_brg" value="<?= $raws['berat_barang']?>" autocomplete="off" Required>
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
                                                        <input type="number" class="form-control" id="inlineFormInputGroup" name="harga_brg" value="<?= $raws['harga_barang']?>" autocomplete="off" Required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">,00</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-2">
                                                    Status
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                    <select class="form-control" id="exampleFormControlSelect1" name="status_brg" Required>
                                                        <?php foreach($status_brg as $s): ?>
                                                        <option><?=$s["nama_status"];?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-beetween"> 
                                            <div class="col mb-1"><button class="btn btn-danger" type="reset" onclick="location.href='<?= $path_brh; ?>'">Kembali</button></div>
                                                <div class="col mb-1"><button class="btn btn-primary" type="submit" name="sbmt" onclick="return confirm('Apakah Anda yakin ingin mengubah barang ini?')">Submit</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="popUpConfirmLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika kamu yakin.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= $path_logout; ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
     <!-- Confirm PW Modal-->
     <div class="modal fade" id="popUpConfirmPW" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                        <form id="formConfirmPW" method="POST">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" type="password" placeholder="Password" id="password1" name="confirmPW" autocomplete="off" required>
                                        <span class="form-control-focus"></span>
                                    </div>
                                    <div class="col-2 mt-2 ms-1">
                                        <div class="input-group-addon" onclick="passwordVisibility(1);">
                                            <i class="fa fa-eye" id="showPass1"></i>
                                            <i class="fa fa-eye-slash d-none" id="hidePass1"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button form="formConfirmPW" type="submit" class="btn btn-primary" name="sbmt-pw">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- PW salah modal-->
    <div class="modal fade" id="popUpConfirmPwSalah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Password Salah!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="#">OK</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src ="<?= $path_vendor; ?>/jquery/jquery.min.js"></script>
    <script src="<?= $path_vendor; ?>/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $path_vendor; ?>/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $path_js; ?>/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= $path_vendor; ?>/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= $path_js; ?>/demo/chart-area-demo.js"></script>
    <script src="<?= $path_js; ?>/demo/chart-pie-demo.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?= $path_js; ?>/script.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.9/css/dataTables.responsive.css"></script>

</body>

</html>


<script>
  $(document).ready(function () {
    $(".table").DataTable();
  });
</script>


