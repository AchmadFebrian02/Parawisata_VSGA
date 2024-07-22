<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
// Fetch the banner image from the database
$queryWisata = mysqli_query($conn, "SELECT * FROM wisata WHERE nama='$nama'");
$wisata = mysqli_fetch_array($queryWisata);

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
    <link rel="stylesheet" href="./css/style.css">
    <title>Parawisata | wisata-detail</title>
</head>

<style>
    .banner-wisata-detail {
        height: 95vh;
        background: url('./image/<?php echo $wisata['foto'] ?>') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Optional: adds a dark overlay to improve text visibility */
    }

    .banner-content {
        position: relative;
        z-index: 2;
    }

    .video-frame {
        position: relative;
        padding-bottom: 85.45%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        max-width: 100%;
        background: #000;
    }

    .video-frame iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

</style>
<body>
    <i><?php require "navigation.php" ?></i>
    <div class="container-fluid banner-wisata-detail">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>Destination <?php echo $wisata['nama'] ?></h1>
            <p><?php echo $wisata['detail'] ?></p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <!-- Embed YouTube video -->
                    <div class="video-frame">
                        <iframe src="<?php echo $wisata['video_url']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                    <div class="col-lg-5 offset-lg-1">
                        <h1><?php echo $wisata['nama']?></h1>
                        <p class="card-text small text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo formatTanggal($wisata['tanggal']) ?></p>
                        <p class="fs-5"><?php echo $wisata['detail']?></p>
                        <p class="card-text price">Rp <?php echo number_format($wisata['harga'], 2, ',', '.') ?></p>
                        <p class="fs-5">Status Paket : <strong><?php echo $wisata['ketersedian_stok'];?></strong></p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Pesan Tiket
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Silahkan Input Tiket Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <form method="POST" action="tiket-pesanan.php">
                                        <div class="form-group mb-3">
                                            <label for="inputNama" class="form-label">Nama :</label>
                                            <input type="text" id="inputNama" name="nama" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputGmail" class="form-label">Gmail :</label>
                                            <input type="email" id="inputGmail" name="gmail" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputNoHp" class="form-label">No Hp :</label>
                                            <input type="text" id="inputNoHp" name="noHp" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputJumlahTiket" class="form-label">Jumlah Tiket :</label>
                                            <input type="number" id="inputJumlahTiket" name="jumlahTiket" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="inputTipeTiket" class="form-label">Tipe Tiket :</label>
                                            <select id="inputTipeTiket" name="tipeTiket" class="form-select" required>
                                                <option value="Reguler">Reguler</option>
                                                <option value="VIP">VIP</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="nama_wisata" value="<?php echo $wisata['nama'] ?>">
                                        <input type="hidden" name="harga" value="<?php echo $wisata['harga'] ?>">
                                        <input type="hidden" name="foto" value="<?php echo $wisata['foto'] ?>">
                                        <input type="hidden" name="tanggal" value="<?php echo $wisata['tanggal'] ?>">
                                        <button type="submit" class="btn btn-primary">Cetak Tiket</button>
                                    </form>
                                    </div>
                                 </div>
                             </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "./footer.php"?>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
