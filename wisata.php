<?php
    require 'koneksi.php';

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

    // get Wisata by nama produk/keyword
    if(isset($_GET['keyword'])){
        $queryWisata = mysqli_query($conn, "SELECT * FROM wisata WHERE nama LIKE '%" . mysqli_real_escape_string($conn, $_GET['keyword']) . "%'");
    }
    // get wisata by kategori
    else if(isset($_GET['kategori'])){
        $queryGetKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='" . mysqli_real_escape_string($conn, $_GET['kategori']) . "'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);
        
        if ($kategoriId) {
            $queryWisata = mysqli_query($conn, "SELECT * FROM wisata WHERE kategori_id='" . mysqli_real_escape_string($conn, $kategoriId['id']) . "'");
        } else {
            
            $queryWisata = mysqli_query($conn, "SELECT * FROM wisata WHERE 0");
        }
    }
    // get wisata defaults
    else{
        $queryWisata = mysqli_query($conn, "SELECT * FROM wisata");
    }

    if ($queryWisata) {
        $countData = mysqli_num_rows($queryWisata);
    } else {
        $countData = 0;
    }
    
    function formatTanggal($tanggal) {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./fontawesome/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="css/style.css">
    <title>Parawisata | Wisata</title>
</head>
<style>
        .banner-wisata{
            height: 55vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('./image/wisata.jpg');
            background-size: cover;
            background-position: 60% 70%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .no-decoration {
            text-decoration: none;
            color: inherit;
        }
    </style>
<body>
    <!-- banner -->
    <i><?php require 'navigation.php'?></i>
    <div class="container-fluid banner-wisata">
        <div class="container">
            <h1 class="text-white">Pariwisata</h1>
        </div>
    </div>
    <!-- Body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori Paket Wisata</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){?>
                    <a class="no-decoration" href="wisata.php?kategori=<?php echo htmlspecialchars($kategori['nama'])?>">
                        <li class="list-group-item"><?php echo htmlspecialchars($kategori['nama']) ?></li>
                    </a>
                    <?php }?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Pariwisata</h3>
                <div class="row">
                    <?php if($countData<1){
                    ?>  
                        <h4 class="text-center">Wisata Yang anda cari tidak tersedia</h4>
                    <?php 
                    }
                    ?>
                    <?php while($wisata = mysqli_fetch_array($queryWisata)){?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="./image/<?php echo $wisata['foto']?>" class="card-img-top" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title mt-3"><?php echo htmlspecialchars($wisata['nama']) ?></h4>
                                <p class="card-text small text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo formatTanggal($wisata['tanggal']) ?></p>
                                <h6 class="card-title text-truncate"><?php echo $wisata['detail']?>....</h6>
                                <p class="card-text price">Rp <?php echo number_format($wisata['harga'], 2, ',', '.') ?></p>
                                <div class="d-flex justify-content-center">
                                    <a href="wisata-detail.php?nama=<?php echo urlencode($wisata['nama']) ?>" class="btn warna3 text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <?php require 'footer.php'?>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
