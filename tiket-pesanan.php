<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaWisata = isset($_POST['nama_wisata']) ? $_POST['nama_wisata'] : 'Nama Wisata Tidak Tersedia';
    $hargaWisata = isset($_POST['harga']) ? (int) $_POST['harga'] : 0;
    $durasi = isset($_POST['durasi']) ? (int) $_POST['durasi'] : 0;
    $jumlahPeserta = isset($_POST['jumlah_peserta']) ? (int) $_POST['jumlah_peserta'] : 0;

    $penginapan = isset($_POST['penginapan']) ? 1000000 : 0;
    $transportasi = isset($_POST['transportasi']) ? 1200000 : 0;
    $makanan = isset($_POST['makanan']) ? 500000 : 0;

    $totalLayananTambahan = ($penginapan + $transportasi + $makanan) * $durasi * $jumlahPeserta;
    $totalTagihan = $hargaWisata * $jumlahPeserta + $totalLayananTambahan;

    $namaPemesan = htmlspecialchars($_POST['nama_pemesan']);
    $noHp = htmlspecialchars($_POST['no_hp']);
    $tanggal = $_POST['tanggal'];

    // Ambil kategori berdasarkan nama wisata
    $queryWisata = mysqli_query($conn, "SELECT kategori_id FROM wisata WHERE nama='$namaWisata'");
    $wisata = mysqli_fetch_array($queryWisata);
    $kategoriId = $wisata['kategori_id'];

    $query = "INSERT INTO pesanan (nama_pemesan, no_hp, nama_wisata, tanggal, durasi, jumlah_peserta, penginapan, transportasi, makanan, total_tagihan, kategori_id, total_layanan) 
              VALUES ('$namaPemesan', '$noHp', '$namaWisata', '$tanggal', $durasi, $jumlahPeserta, $penginapan, $transportasi, $makanan, $totalTagihan, $kategoriId, $totalLayananTambahan)";

    if ($conn->query($query) === TRUE) {
        // Berhasil disimpan
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
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
    return isset($bulan[(int)$split[1]]) ? $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0] : $tanggal;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Konfirmasi Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .ticket-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .ticket-header h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 10px;
        }
        .ticket-header p {
            font-size: 1.5em;
            color: #555;
        }
        .ticket-body {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .ticket-body img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .ticket-footer {
            text-align: center;
        }
        .btn-back {
            background-color: #6c757d;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            margin: 5px;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        @media print {
            .btn-print, .btn-download {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket-header">
            <h1>Tiket Pemesanan Wisata</h1>
            <p><?php echo htmlspecialchars($_POST['nama_wisata']); ?></p>
        </div>
        <div class="ticket-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="image/<?php echo htmlspecialchars($_POST['foto']); ?>" alt="Gambar Wisata" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px;">
                </div>
                <div class="col-md-6">
                    <p><strong>Nama Pemesan:</strong> <?php echo htmlspecialchars($_POST['nama_pemesan']); ?></p>
                    <p><strong>Nomor Telp/HP:</strong> <?php echo htmlspecialchars($_POST['no_hp']); ?></p>
                    <p><strong>Tanggal Keberangkatan:</strong> <?php echo formatTanggal(isset($_POST['tanggal']) ? $_POST['tanggal'] : ''); ?></p>
                    <p><strong>Durasi Perjalanan:</strong> <?php echo $durasi; ?> hari</p>
                    <p><strong>Jumlah Peserta:</strong> <?php echo $jumlahPeserta; ?> orang</p>
                    <p><strong>Total Layanan Tambahan:</strong> Rp <?php echo number_format($totalLayananTambahan, 2, ',', '.'); ?></p>
                    <p><strong>Total Tagihan:</strong> Rp <?php echo number_format($totalTagihan, 2, ',', '.'); ?></p>
                    <?php
                    // Ambil nama kategori berdasarkan kategori_id
                    $queryKategori = mysqli_query($conn, "SELECT nama FROM kategori WHERE id='$kategoriId'");
                    $kategori = mysqli_fetch_array($queryKategori);
                    ?>
                    <p><strong>Kategori:</strong> <?php echo htmlspecialchars($kategori['nama']); ?></p>
                </div>
            </div>
        </div>
        <div class="ticket-footer">
            <form method="POST" action="">
                <input type="hidden" name="nama_pemesan" value="<?php echo htmlspecialchars($_POST['nama_pemesan']); ?>">
                <input type="hidden" name="no_hp" value="<?php echo htmlspecialchars($_POST['no_hp']); ?>">
                <input type="hidden" name="nama_wisata" value="<?php echo htmlspecialchars($_POST['nama_wisata']); ?>">
                <input type="hidden" name="tanggal" value="<?php echo htmlspecialchars($_POST['tanggal']); ?>">
                <input type="hidden" name="durasi" value="<?php echo $durasi; ?>">
                <input type="hidden" name="jumlah_peserta" value="<?php echo $jumlahPeserta; ?>">
                <input type="hidden" name="penginapan" value="<?php echo $penginapan; ?>">
                <input type="hidden" name="transportasi" value="<?php echo $transportasi; ?>">
                <input type="hidden" name="makanan" value="<?php echo $makanan; ?>">
                <input type="hidden" name="harga" value="<?php echo $hargaWisata; ?>">
                <input type="hidden" name="foto" value="<?php echo htmlspecialchars($_POST['foto']); ?>">
                <a href="javascript:window.print()" class="btn btn-print btn-primary no-decoration">Cetak Tiket</a>
                <a href="javascript:history.back()" class="btn btn-print btn-danger">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
