<?php 

require 'function.php';

$raws = getData("SELECT * FROM barang");
$path_img = "img";
$path_profil = "profil.php";


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Style CSS sendiri -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="<?=$path_img;?>/Logo_Mitra_lingkaran.png">
  
  <title>Gemol Indonesia</title>
</head>

<body>
  <!-- awal navbar -->
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-brand" href="#">
          <img src="<?= $path_img; ?>/Logo_Mitra.png" class="rounded-circle" alt="" width="30" height="30"
            class="d-inline-block align-text-top">
          Gemol
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="btn btn-navbar me-1 h6 btn-warning" href="#">Home</a>
          </li>
          <li class="nav-item ">
            <a class="btn btn-navbar me-1 h6" href="<?= $path_profil; ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-navbar me-1 h6" href="#">Ulasan</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-navbar me-1 h6" href="#">Testimoni</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-navbar me-1 h6" href="#">FAQ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- akhir navbar -->


   <!-- awal Carousel -->
   <section class="carousel">
    <div class="container justify-content-center w-75">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-item active">
            <img src="<?= $path_img;?>/carousel-katalog/carousel1.jpg" class="d-block w-100" alt="<?= $path_img;?>/carousel-katalog/carousel1.jpg" />
          </div>
          <div class="carousel-item">
            <img src="<?= $path_img;?>/carousel-katalog/carousel1.jpg" class="d-block w-100" alt="<?= $path_img;?>/carousel-katalog/carousel1.jpg" />
          </div>
          <div class="carousel-item">
            <img src="<?= $path_img;?>/carousel-katalog/carousel1.jpg" class="d-block w-100" alt="<?= $path_img;?>/carousel-katalog/carousel1.jpg" />
          </div>
          <div class="carousel-item">
            <img src="<?= $path_img;?>/carousel-katalog/carousel1.jpg" class="d-block w-100" alt="<?= $path_img;?>/carousel1.jpg" />
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <!-- akhir Carousel -->

  <!-- awal konten -->
  <div id="content">
    <div class="container mt-1">
      <div class="row text-center">
        <div class="col">
          <p class="h1">Katalog</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <!-- awal card -->
        <?php foreach($raws as $r): ?>
        <div class="col-md-3 mb-4">
          <div class="card h-100">
            <img src="<?= $path_img; ?>/<?= $r['foto_barang']; ?>" class="card-img-top" alt="" />
            <div class="container">
              <div class="card-body">
                <div class="row ">
                  <div class="col-12 ms-0">
                    <h5 class="card-title"><?= $r['nama_barang']; ?></h5>
                  </div>
                  <div class="col-1 me-2 ">
                    <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button>
                  </div>
                  <div class="col-1 ms-1">
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                  </div>
                </div>
                <div class="row">
                  <div class="h5">Rp.<?= $r['harga_barang']; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        <!-- akhir card -->
      </div>
    </div>
  </div>
  <!-- akhir konten -->




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>