<?php
require "koneksi.php";

function formatTanggal($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaWisata = htmlspecialchars($_POST['nama_wisata']);
    $namaPemesan = htmlspecialchars($_POST['nama']);
    $gmail = htmlspecialchars($_POST['gmail']);
    $noHp = htmlspecialchars($_POST['noHp']);
    $jumlahTiket = htmlspecialchars($_POST['jumlahTiket']);
    $tipeTiket = htmlspecialchars($_POST['tipeTiket']);
    $harga = htmlspecialchars($_POST['harga']);
    $foto = htmlspecialchars($_POST['foto']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $tanggalTiket = date('Y-m-d');

    // Siapkan data untuk ditampilkan pada tiket pesanan
    $tiketPesanan = array(
        'namaWisata' => $namaWisata,
        'namaPemesan' => $namaPemesan,
        'gmail' => $gmail,
        'noHp' => $noHp,
        'jumlahTiket' => $jumlahTiket,
        'tipeTiket' => $tipeTiket,
        'harga' => $harga,
        'foto' => $foto,
        'tanggal' => $tanggal,
        'tanggalTiket' => formatTanggal($tanggalTiket)
    );
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <title>Parawisata | Tiket Pesanan</title>
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
            height: 400x;
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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if (isset($tiketPesanan)): ?>
                    <div class="ticket">
                        <h2 class="text-center">Tiket Pesanan</h2>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <img src="./image/<?php echo $tiketPesanan['foto'] ?>" alt="Foto Wisata">
                            </div>
                            <div class="col-md-6">
                                <p><strong>Nama Wisata:</strong> <?php echo $tiketPesanan['namaWisata'] ?></p>
                                <p><strong>Nama Lengkap Pemesan:</strong> <?php echo $tiketPesanan['namaPemesan'] ?></p>
                                <p><strong>Email:</strong> <?php echo $tiketPesanan['gmail'] ?></p>
                                <p><strong>No Hp:</strong> <?php echo $tiketPesanan['noHp'] ?></p>
                                <p><strong>Jumlah Tiket:</strong> <?php echo $tiketPesanan['jumlahTiket'] ?></p>
                                <p><strong>Tipe Tiket:</strong> <?php echo $tiketPesanan['tipeTiket'] ?></p>
                                <p><strong>Harga Tiket:</strong> Rp <?php echo number_format($tiketPesanan['harga'], 2, ',', '.') ?></p>
                                <p><strong>Tanggal Tiket:</strong> <?php echo $tiketPesanan['tanggalTiket'] ?></p>
                            </div>
                            <button id="exportToPDF" class="btn btn-primary">Cetak Tiket</button>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Data tiket pesanan tidak tersedia.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('exportToPDF').addEventListener('click', () => {
        const element = document.querySelector('.ticket');
        const button = document.getElementById('exportToPDF');
        
        // Menyembunyikan tombol sebelum proses PDF dimulai
        button.classList.add('hide-in-pdf');
        // Konfigurasi untuk html2pdf
        const opt = {
                margin:       [0.5, 0.5, 0.5, 0.5], // top, right, bottom, left
                filename:     'tiket_pesanan.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                pagebreak:    { mode: ['avoid-all'] },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // Mengonversi elemen menjadi PDF
            html2pdf().from(element).set(opt).save().finally(() => {
                // Menampilkan kembali tombol setelah proses PDF selesai
                button.classList.remove('hide-in-pdf');
            });
    });
</script>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
