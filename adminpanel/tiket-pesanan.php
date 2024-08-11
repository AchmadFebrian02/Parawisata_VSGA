<?php 
    require "session.php";
    require "../koneksi.php";

    // Pagination configuration
    $items_per_page = 5; // Number of items per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $items_per_page;

    // Inisialisasi kondisi filter
    $conditions = [];

    if (isset($_GET['nama_pemesan']) && $_GET['nama_pemesan'] != '') {
        $nama_pemesan = $_GET['nama_pemesan'];
        $conditions[] = "p.nama_pemesan LIKE '%$nama_pemesan%'";
    }

    if (isset($_GET['nama_wisata']) && $_GET['nama_wisata'] != '') {
        $nama_wisata = $_GET['nama_wisata'];
        $conditions[] = "p.nama_wisata LIKE '%$nama_wisata%'";
    }

    if (isset($_GET['tanggal']) && $_GET['tanggal'] != '') {
        $tanggal = $_GET['tanggal'];
        $conditions[] = "p.tanggal = '$tanggal'";
    }

    if (isset($_GET['kategori_id']) && $_GET['kategori_id'] != '') {
        $kategori_id = $_GET['kategori_id'];
        $conditions[] = "p.kategori_id = '$kategori_id'";
    }

    // Query untuk mengambil data pesanan dan kategori
    $sql = "SELECT p.*, k.nama AS kategori_nama
            FROM pesanan p
            LEFT JOIN kategori k ON p.kategori_id = k.id";

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    $sql_count = $sql;
    $sql .= " LIMIT $offset, $items_per_page";
    
    $querypesanan = mysqli_query($conn, $sql);
    $jumlahpesanan = mysqli_num_rows($querypesanan);

    // Get total records for pagination
    $result_count = mysqli_query($conn, $sql_count);
    $total_records = mysqli_num_rows($result_count);
    $total_pages = ceil($total_records / $items_per_page);

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

    $pesan = isset($_GET['message']) ? $_GET['message'] : '';
    $tipe_pesan = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"> 
    <title>Data Pesanan</title>
</head>
<body>
    <?php require './navbar.php'?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/" class="no-decoration text-muted"><i class="fa fa-home" aria-hidden="true"> home</i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pesanan
                </li>
            </ol>
        </nav>
        
        <?php if ($pesan): ?>
            <div class="alert alert-<?= $tipe_pesan === 'success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                <?= $pesan ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form Filter -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="nama_pemesan" class="form-control" placeholder="Nama Pemesan" value="<?= isset($_GET['nama_pemesan']) ? $_GET['nama_pemesan'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="nama_wisata" class="form-control" placeholder="Wisata" value="<?= isset($_GET['nama_wisata']) ? $_GET['nama_wisata'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <select name="kategori_id" class="form-control">
                        <option value="">Semua Kategori</option>
                        <?php
                        $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
                        while($kategori = mysqli_fetch_assoc($queryKategori)) {
                            $selected = isset($_GET['kategori_id']) && $_GET['kategori_id'] == $kategori['id'] ? 'selected' : '';
                            echo "<option value='" . $kategori['id'] . "' $selected>" . $kategori['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                <div class="col-md-3 mt-2">
                    <a href="tiket-pesanan.php" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="my-5 col-12 col-md-6">
            <h2>Data Parawisata</h2>
            <p>Berisi data yang telah disimpan di database</p>
        </div>
        <div class="table-responsive mt-2 center-table">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Pemesan</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">NoHp</th>
                            <th class="text-center">Wisata</th>
                            <th class="text-center">Tangal</th>
                            <th class="text-center">Perjalanan</th>
                            <th class="text-center">Peserta</th>
                            <th class="text-center">Penginapan</th>
                            <th class="text-center">Transportasi</th>
                            <th class="text-center">Makanan</th>
                            <th class="text-center">Total Layanan</th>
                            <th class="text-center">Total Tagihan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($jumlahpesanan == 0){
                                echo '<tr><td colspan="14" class="text-center align-middle">Data Wisata Tidak tersedia</td></tr>';
                            } else {
                                $jumlah = 1 + $offset;
                                while($pesanan = mysqli_fetch_array($querypesanan)) {
                                    echo '<tr>';
                                    echo '<td class="text-center align-middle">' . $jumlah . '</td>';
                                    echo '<td class="align-middle">' . $pesanan['nama_pemesan'] . '</td>';
                                    echo '<td class="align-middle">' . ($pesanan['kategori_nama'] ? $pesanan['kategori_nama'] : 'N/A') . '</td>';
                                    echo '<td class="align-middle">' . $pesanan['no_hp'] . '</td>';
                                    echo '<td class="align-middle text-center">' . $pesanan['nama_wisata'] . '</td>';
                                    echo '<td class="align-middle">' . formatTanggal($pesanan['tanggal']) . '</td>';
                                    echo '<td class="align-middle">' . $pesanan['durasi'] . ' Hari</td>';
                                    echo '<td class="align-middle">' . $pesanan['jumlah_peserta'] . ' Orang</td>';
                                    echo '<td class="card-text price">Rp ' . number_format($pesanan['penginapan'], 2, ',', '.') . '</td>';
                                    echo '<td class="card-text price">Rp ' . number_format($pesanan['transportasi'], 2, ',', '.') . '</td>';
                                    echo '<td class="card-text price">Rp ' . number_format($pesanan['makanan'], 2, ',', '.') . '</td>';
                                    echo '<td class="card-text price">Rp ' . number_format($pesanan['total_layanan'], 2, ',', '.') . '</td>';
                                    echo '<td class="card-text price">Rp ' . number_format($pesanan['total_tagihan'], 2, ',', '.') . '</td>';
                                    echo '<td class="text-center align-middle">';
                                    echo '<a href="tiket-detail.php?p=' . $pesanan['id'] . '" class="btn btn-success">';
                                    echo '<i class="fa fa-search" aria-hidden="true"></i>';
                                    echo '</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                    $jumlah++;
                                }
                            }          
                        ?>
                    </tbody>
                </table>
             </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php
                    // Variabel untuk mengatur jumlah link halaman yang ditampilkan
                    $total_links = 5;
                    $start = max(1, $page - floor($total_links / 2));
                    $end = min($total_pages, $start + $total_links - 1);
                    
                    // Menyesuaikan start jika end sudah mencapai total_pages
                    if ($end - $start < $total_links - 1) {
                        $start = max(1, $end - $total_links + 1);
                    }
                    
                    // Tautan Previous
                    if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 . (isset($_GET['nama_pemesan']) ? '&nama_pemesan=' . $_GET['nama_pemesan'] : '') . 
                                (isset($_GET['nama_wisata']) ? '&nama_wisata=' . $_GET['nama_wisata'] : '') . 
                                (isset($_GET['tanggal']) ? '&tanggal=' . $_GET['tanggal'] : '') . 
                                (isset($_GET['kategori_id']) ? '&kategori_id=' . $_GET['kategori_id'] : '') ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif;

                    // Link halaman
                    for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i . (isset($_GET['nama_pemesan']) ? '&nama_pemesan=' . $_GET['nama_pemesan'] : '') . 
                                (isset($_GET['nama_wisata']) ? '&nama_wisata=' . $_GET['nama_wisata'] : '') . 
                                (isset($_GET['tanggal']) ? '&tanggal=' . $_GET['tanggal'] : '') . 
                                (isset($_GET['kategori_id']) ? '&kategori_id=' . $_GET['kategori_id'] : '') ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor;

                    // Tautan Next
                    if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 . (isset($_GET['nama_pemesan']) ? '&nama_pemesan=' . $_GET['nama_pemesan'] : '') . 
                                (isset($_GET['nama_wisata']) ? '&nama_wisata=' . $_GET['nama_wisata'] : '') . 
                                (isset($_GET['tanggal']) ? '&tanggal=' . $_GET['tanggal'] : '') . 
                                (isset($_GET['kategori_id']) ? '&kategori_id=' . $_GET['kategori_id'] : '') ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
    </div>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
