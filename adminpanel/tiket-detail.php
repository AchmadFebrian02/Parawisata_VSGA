<?php 
require "session.php";
require "../koneksi.php";

if (!isset($_GET['p']) || empty($_GET['p'])) {
    die("ID tiket tidak valid.");
}

$id_tiket = htmlspecialchars($_GET['p']);
$query = mysqli_query($conn, "SELECT * FROM tiket_pesanan WHERE id = '$id_tiket'");
$tiket = mysqli_fetch_array($query);

if (!$tiket) {
    die("Tiket tidak ditemukan.");
}

function formatTanggal($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
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
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"> 
    <title>Detail Tiket Pesanan</title>
    <style>
        .ticket {
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .ticket img {
            position: relative;
            display: block;
            width: 100%;
            height: 400px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .ticket h2 {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .hide-in-pdf {
            display: none;
        }
    </style>
</head>
<body>
    <?php require './navbar.php'?>
    <div class="container mt-5">
        <div class="ticket">
            <h2 class="text-center">Tiket Pesanan</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <img src="../image/<?php echo $tiket['foto'] ?>" alt="Foto Wisata">
                </div>
                <div class="col-md-6">
                    <p><strong>Nama Wisata:</strong> <?php echo $tiket['nama_wisata'] ?></p>
                    <p><strong>Nama Lengkap Pemesan:</strong> <?php echo $tiket['nama'] ?></p>
                    <p><strong>Email:</strong> <?php echo $tiket['gmail'] ?></p>
                    <p><strong>No Hp:</strong> <?php echo $tiket['no_hp'] ?></p>
                    <p><strong>Jumlah Tiket:</strong> <?php echo $tiket['jumlah_tiket'] ?></p>
                    <p><strong>Tipe Tiket:</strong> <?php echo $tiket['tipe_tiket'] ?></p>
                    <p><strong>Harga Tiket:</strong> Rp <?php echo number_format($tiket['harga'], 2, ',', '.') ?></p>
                    <p><strong>Tanggal Tiket:</strong> <?php echo formatTanggal($tiket['tanggal']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
