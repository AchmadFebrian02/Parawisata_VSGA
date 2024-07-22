<?php
    require "session.php";
    require "../koneksi.php";

    $querykategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahkategori = mysqli_num_rows($querykategori);

    
    $querywisata = mysqli_query($conn, "SELECT * FROM wisata");
    $jumlahwisata = mysqli_num_rows($querywisata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"> 
    <title>dashboard</title>
</head>
<style>
    .kotak{
        border: solid;
    }
    .summary-kategori{
        background-color: #448c23;
        border-radius: 15px;
    }
    .summary-wisata{
        background-color: #125899;
        border-radius: 15px;
    }
    .no-decoration{
        text-decoration: none;
    }
</style>
<body>
    <?php require "navbar.php"?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                <i class="fa fa-home" aria-hidden="true"> home</i>
                </li>
            </ol>
        </nav>
        <h2>Halo <?php echo $_SESSION ['username']?></h2>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-4">
                        <div class="row">
                            <div class="col-5">
                             <i class="fa fa-server fa-5x text-black-50" aria-hidden="true"></i>
                            </div>
                            <div class="col-5 text-white">
                            <h3 class="fs-2">kategori</h3>
                            <p class="fs-5"><?php echo$jumlahkategori ?> kategori</p>
                            <p><a href="kategori.php" class="text-white no-decoration">Lihat detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-wisata p-4">
                    <div class="row">
                        <div class="col-5">
                        <i class="fa fa-suitcase fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-5 text-white">
                            <h3 class="fs-2">Wisata</h3>
                            <p class="fs-5"><?php echo$jumlahwisata ?> wisata</p>
                            <p><a href="kategori.php" class="text-white no-decoration">Lihat detail</a></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>