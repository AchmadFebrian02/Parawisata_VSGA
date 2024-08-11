<?php 
    require "session.php";
    require "../koneksi.php";

    // Mengambil ID pesanan dari URL
    if (isset($_GET['p'])) {
        $id_pesanan = $_GET['p'];

        // Query untuk mengambil detail pesanan berdasarkan ID
        $query = mysqli_query($conn, "
            SELECT p.*, k.nama AS kategori_nama
            FROM pesanan p
            LEFT JOIN kategori k ON p.kategori_id = k.id
            WHERE p.id = '$id_pesanan'
        ");

        // Cek apakah pesanan ditemukan
        if (mysqli_num_rows($query) > 0) {
            $pesanan = mysqli_fetch_assoc($query);
        } else {
            echo "<script>
                    alert('Pesanan tidak ditemukan');
                    window.location.href = 'data-pesanan.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('ID Pesanan tidak valid');
                window.location.href = 'data-pesanan.php';
              </script>";
        exit();
    }

    // Proses penghapusan data pesanan
    if (isset($_POST['delete'])) {
        $queryHapus = mysqli_query($conn, "DELETE FROM pesanan WHERE id='$id_pesanan'");
        if ($queryHapus) {
            header('Location: tiket-pesanan.php?status=success&message=Pesanan berhasil dihapus');
            exit();
        } else {
            header('Location: tiket-pesanan.php?status=error&message=Gagal menghapus pesanan');
            exit();
        }
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
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"> 
    <title>Detail Tiket Pesanan</title>
</head>
<body>
    <?php require './navbar.php'?>
    <div class="container mt-5">
        <h2>Detail Tiket Pesanan</h2>
        <div class="card mt-3">
            <div class="card-header">
                <h4>Pesanan #<?= $pesanan['id'] ?></h4>
            </div>
            <div class="card-body">
                <p><strong>Nama Pemesan:</strong> <?= $pesanan['nama_pemesan'] ?></p>
                <p><strong>No HP:</strong> <?= $pesanan['no_hp'] ?></p>
                <p><strong>Wisata:</strong> <?= $pesanan['nama_wisata'] ?></p>
                <p><strong>Tanggal:</strong> <?= formatTanggal($pesanan['tanggal']) ?></p>
                <p><strong>Durasi Perjalanan:</strong> <?= $pesanan['durasi'] ?> Hari</p>
                <p><strong>Jumlah Peserta:</strong> <?= $pesanan['jumlah_peserta'] ?> Orang</p>
                <p><strong>Penginapan:</strong> Rp <?= number_format($pesanan['penginapan'], 2, ',', '.') ?></p>
                <p><strong>Transportasi:</strong> Rp <?= number_format($pesanan['transportasi'], 2, ',', '.') ?></p>
                <p><strong>Makanan:</strong> Rp <?= number_format($pesanan['makanan'], 2, ',', '.') ?></p>
                <p><strong>Total Tagihan:</strong> Rp <?= number_format($pesanan['total_tagihan'], 2, ',', '.') ?></p>
                <p><strong>Total Layanan:</strong> Rp <?= number_format($pesanan['total_layanan'], 2, ',', '.') ?></p>
                <p><strong>Kategori:</strong> <?= $pesanan['kategori_nama'] ? $pesanan['kategori_nama'] : 'N/A' ?></p>
            </div>
            <div class="card-footer">
                <a href="tiket-pesanan.php" class="btn btn-secondary">Kembali</a>
                <form method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-danger" name="delete">
                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
