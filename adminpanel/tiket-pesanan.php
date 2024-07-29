<?php 
    require "session.php";
    require "../koneksi.php";

    $querypesanan = mysqli_query($conn, "SELECT * FROM tiket_pesanan");
    $jumlahpesanan = mysqli_num_rows($querypesanan);

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

        <div class="my-5 col-12 col-md-6">
            <h2>Data Parawisata</h2>
            <p>Berisi data yang telah disimpan di database</p>
        </div>
        <div class="table-responsive mt-2 center-table">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Gmail</th>
                            <th class="text-center">NoHp</th>
                            <th class="text-center">Jumlah tiket</th>
                            <th class="text-center">Tipe tiket</th>
                            <th class="text-center">Wisata</th>
                            <th class="text-center">harga</th>
                            <th class="text-center">foto</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($jumlahpesanan==0){
                                ?>
                                <tr>
                                    <td colspan="10" class="text-center align-middle">Data Wisata Tidak tersedia</td>
                                </tr>
                                <?php
                            }        
                            else{
                                $jumlah=1;
                                while($pesanan=mysqli_fetch_array($querypesanan)){
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo $jumlah ?></td>
                                        <td class="align-middle"><?php echo $pesanan['nama']?></td>
                                        <td class="align-middle"><?php echo $pesanan['gmail']?></td>
                                        <td class="align-middle"><?php echo $pesanan['no_hp']?></td>
                                        <td class="align-middle text-center"><?php echo  $pesanan['jumlah_tiket']?></td>
                                        <td class="align-middle"><?php echo $pesanan['tipe_tiket']?></td>
                                        <td class="align-middle"><?php echo $pesanan['nama_wisata']?></td>
                                        <td class="align-middle">Rp <?php echo number_format($pesanan['harga'], 2, ',', '.') ?></td>
                                        <td class="text-center align-middle"><img src="../image/<?php echo $pesanan['foto']?>" alt="" width="100px"></td>
                                        <td class="align-middle"><?php echo formatTanggal($pesanan['tanggal'])?></td>
                                        <td class="text-center align-middle">
                                            <a href="tiket-detail.php?p=<?php echo $pesanan['id']?>" class="btn btn-success">
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
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>