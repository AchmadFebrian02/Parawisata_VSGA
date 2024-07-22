<?php
    require "session.php";
    require "../koneksi.php";

    $querywisata = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM wisata a JOIN kategori b ON a.kategori_id=b.id");
    $jumlahwisata = mysqli_num_rows($querywisata);

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
        <div>
            <a href="kelola_wisata.php" type="button" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Tambahkan Data
            </a>
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
                if($jumlahwisata==0){
                    ?>
                    <tr>
                        <td colspan="9" class="text-center align-middle">Data Wisata Tidak tersedia</td>
                    </tr>
                    <?php
                }        
                else{
                    $jumlah=1;
                    while($data=mysqli_fetch_array($querywisata)){
                        ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo $jumlah ?></td>
                            <td class="align-middle"><?php echo $data['nama']?></td>
                            <td class="align-middle"><?php echo $data['nama_kategori']?></td>
                            <td class="align-middle"><?php echo formatTanggal($data['tanggal'])?></td>
                            <td class="align-middle"><?php echo $data['harga']?></td>
                            <td class="align-middle"><?php echo $data['ketersedian_stok']?></td>
                            <td class="text-center align-middle"><img src="../image/<?php echo $data['foto']?>" alt="" width="100px"></td>
                            <td class="align-middle"><?php echo $data['video_url']?></td>
                            <td class="text-center align-middle">
                                <a href="wisata-detail.php?p=<?php echo $data['id']?>" class="btn btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $jumlah++;
                    }
                }          
            ?>
        </tbody>
    </table>
</div>

        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
