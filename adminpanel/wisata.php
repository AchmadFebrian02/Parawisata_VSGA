<?php
require "session.php";
require "../koneksi.php";

// Pagination configuration
$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Offset calculation

// Filter configuration
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

$where_clause = '';
if ($filter_kategori) {
    $where_clause = "WHERE a.kategori_id = '$filter_kategori'";
}

// Get total records
$queryTotal = mysqli_query($conn, "SELECT COUNT(*) AS total FROM wisata a $where_clause");
$totalRecords = mysqli_fetch_assoc($queryTotal)['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch records with pagination and filter
$querywisata = mysqli_query($conn, "
    SELECT a.*, b.nama AS nama_kategori 
    FROM wisata a 
    JOIN kategori b ON a.kategori_id=b.id 
    $where_clause 
    LIMIT $offset, $limit
");
$jumlahwisata = mysqli_num_rows($querywisata);

function formatTanggal($tanggal) {
    $bulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 
        'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
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
    <title>Parawisata</title>
    <style>
        .center-table {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/" class="no-decoration text-muted"><i class="fa fa-home" aria-hidden="true"> home</i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    wisata
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h2>Data Parawisata</h2>
            <p>Berisi data yang telah disimpan di database</p>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="wisata.php">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="kategori">Filter by Kategori:</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Semua Kategori</option>
                        <?php
                        $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_assoc($queryKategori)) {
                            $selected = ($filter_kategori == $kategori['id']) ? 'selected' : '';
                            echo "<option value='{$kategori['id']}' $selected>{$kategori['nama']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <div>
            <a href="kelola_wisata.php" type="button" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Tambahkan Data
            </a>
        </div>
        
        <div class="table-responsive mt-2 center-table">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Ketersediaan</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Video URL</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($jumlahwisata == 0) {
                        echo "<tr><td colspan='9' class='text-center align-middle'>Data Wisata Tidak tersedia</td></tr>";
                    } else {
                        $no = $offset + 1;
                        while ($data = mysqli_fetch_array($querywisata)) {
                            echo "<tr>
                                    <td class='text-center align-middle'>{$no}</td>
                                    <td class='align-middle'>{$data['nama']}</td>
                                    <td class='align-middle'>{$data['nama_kategori']}</td>
                                    <td class='align-middle'>" . formatTanggal($data['tanggal']) . "</td>
                                    <td class='align-middle'>Rp " . number_format($data['harga'], 2, ',', '.') . "</td>
                                    <td class='align-middle'>{$data['ketersedian_stok']}</td>
                                    <td class='text-center align-middle'><img src='../image/{$data['foto']}' alt='' width='100px'></td>
                                    <td class='align-middle'>{$data['video_url']}</td>
                                    <td class='text-center align-middle'>
                                        <a href='wisata-detail.php?p={$data['id']}' class='btn btn-success'>
                                            <i class='fa fa-search' aria-hidden='true'></i>
                                        </a>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>&kategori=<?= $filter_kategori ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&kategori=<?= $filter_kategori ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>&kategori=<?= $filter_kategori ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
