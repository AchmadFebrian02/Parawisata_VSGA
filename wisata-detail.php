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
                            <!-- Formulir pemesanan tiket -->
                            <form method="POST" action="tiket-pesanan.php">
                                <div class="form-group mb-3">
                                    <label for="namaPemesan" class="form-label"><i class="fa fa-user" aria-hidden="true"></i> Nama Pemesan:</label>
                                    <input type="text" id="namaPemesan" name="nama_pemesan" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="noHp" class="form-label"><i class="fa fa-phone" aria-hidden="true"></i> Nomor Telp/HP:</label>
                                    <input type="text" id="noHp" name="no_hp" class="form-control" placeholder="Masukkan nomor telepon aktif" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label"><i class="fa fa-cogs" aria-hidden="true"></i> Pelayanan Paket Perjalanan:</label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="penginapan" name="penginapan" value="1">
                                        <label class="form-check-label" for="penginapan"><i class="fa fa-bed" aria-hidden="true"></i> Penginapan (Rp 1.000.000/hari)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="transportasi" name="transportasi" value="1">
                                        <label class="form-check-label" for="transportasi"><i class="fa fa-bus" aria-hidden="true"></i> Transportasi (Rp 1.200.000/hari)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="makanan" name="makanan" value="1">
                                        <label class="form-check-label" for="makanan"><i class="fa fa-cutlery" aria-hidden="true"></i> Makanan (Rp 500.000/hari)</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="durasi" class="form-label"><i class="fa fa-calendar" aria-hidden="true"></i> Durasi Perjalanan (hari):</label>
                                    <input type="number" id="durasi" name="durasi" class="form-control" placeholder="Masukkan jumlah hari perjalanan" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlahPeserta" class="form-label"><i class="fa fa-users" aria-hidden="true"></i> Jumlah Peserta:</label>
                                    <input type="number" id="jumlahPeserta" name="jumlah_peserta" class="form-control" placeholder="Masukkan jumlah peserta" required>
                                </div>
                                <input type="hidden" name="nama_wisata" value="<?php echo $wisata['nama'] ?>">
                                <input type="hidden" name="harga" value="<?php echo $wisata['harga'] ?>">
                                <input type="hidden" name="foto" value="<?php echo $wisata['foto'] ?>">
                                <input type="hidden" name="tanggal" value="<?php echo $wisata['tanggal'] ?>">
                                <button type="submit" class="btn btn-success"><i class="fa fa-calculator" aria-hidden="true"></i> Hitung Jumlah Tagihan</button>
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
