<?php 
    require "koneksi.php";

    $queryWisata = mysqli_query($conn, "SELECT id, nama, tanggal, harga, foto, detail, ketersedian_stok FROM wisata LIMIT 6");

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
    <link href="./css/style.css" rel="stylesheet">
    <title>Parawisata | Home</title>
</head>

<style>
    .warna1{
    background-color: #492ee7;
}
	.warna2{
    background-color: #508C9B;
}
	.banner{
    height: 80vh;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('./image/wisata.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}
.highlighted-kategori {
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
}

.highlighted-kategori:hover {
    transform: scale(1.05);
}

.highlighted-kategori::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.highlighted-kategori:hover::before {
    opacity: 1;
}

.highlighted-kategori h4 {
    position: relative;
    z-index: 2;
}

.highlighted-kategori .no-decoration {
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
    color: inherit;
}

</style>
<body>
<!-- Banner -->
<i><?php require 'navigation.php'?></i>
    <div class="container-fluid banner">
        <div class="container mb-5">
                <i><h5 class="my-1" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Travel go</h5></i>
                <h1 style="font-size: 70px;">Solusi Perjalanan Wisata Anda</h1>
                <h3 class="mb-2" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Mau cari wisata apa ?</h3>
        <div class="col-md-8 offset-md-2">
            <form action="wisata.php" method="get">
                <div class="input-group input-group-lg my-4">
                     <input type="text" class="form-control" placeholder="Wisata Perjalanan" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                    <button type="submit" class="btn warna1 text-white">Telusuri</button>
                </div>
            </div>
            </form>
        </div>
    </div>
<!-- Kategori Terlaris -->
<div class="container-fluid py-4">
    <div class="container text-center">
        <h3>Paket Wisata Terlaris</h3>

        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <a href="wisata.php?kategori=Bali" class="highlighted-kategori kategori-bali d-flex justify-content-center align-items-center no-decoration">
                    <h4 class="text-white">Paket Wisata Bali</h4>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="wisata.php?kategori=Jawa" class="highlighted-kategori kategori-jawa d-flex justify-content-center align-items-center no-decoration">
                    <h4 class="text-white">Paket Wisata Jawa</h4>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="wisata.php?kategori=NTT" class="highlighted-kategori kategori-labuan-bajo d-flex justify-content-center align-items-center no-decoration">
                    <h4 class="text-white">Paket Wisata Nusa Tenggara Timur</h4>
                </a>
            </div>
        </div>
    </div>
</div>



<!-- Tentang Kami -->
<div class="container-fluid warna2 py-4">
    <div class="container">
        <h3 class="text-center text-white">About Activity</h3>
        <div class="row mt-4">
            <div class="col-lg-6 mb-4 mb-lg-0 video-container">
                <iframe src="https://www.youtube.com/embed/ojQbArbuN4E?si=KCzgpzBoHpTohBTz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6">
                <p class="fs-8 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni voluptatibus eligendi est debitis autem quod nisi quidem officia cupiditate, quia eaque modi consequatur quibusdam, at in consectetur itaque aspernatur quis sed facilis repellat magnam a dolor. Quo delectus eaque porro officia, laboriosam exercitationem nihil accusantium non! Iure exercitationem tempore illum earum ad iste velit quo, aspernatur, quos nihil, qui molestiae ullam hic. Quam illo, nobis rem nostrum sapiente nam velit totam expedita ullam reprehenderit similique amet ipsa repudiandae odit explicabo voluptas reiciendis repellat, ipsum vero fugiat autem harum doloribus eum.</p>
                <p class="fs-8 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni voluptatibus eligendi est debitis autem quod nisi quidem officia cupiditate, quia eaque modi consequatur quibusdam, at in consectetur itaque aspernatur quis sed facilis repellat magnam a dolor. Quo delectus eaque porro officia, laboriosam exercitationem nihil accusantium non! Iure exercitationem tempore illum earum ad iste velit quo, aspernatur, quos nihil, qui molestiae ullam hic. Quam illo, nobis rem nostrum sapiente nam velit totam expedita ullam reprehenderit similique amet ipsa repudiandae odit explicabo voluptas reiciendis repellat, ipsum vero fugiat autem harum doloribus eum.</p>
            </div>
        </div>
    </div>
</div>
<!-- Wisata -->
    <div class="container-fluid py-4">
        <div class="container">
            <h3 class="text-center">Wisata</h3>

            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryWisata)){?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="./image/<?php echo $data['foto']?>" class="card-img-top" alt="">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mt-3"><?php echo $data['nama']?></h4>
                            <p class="card-text small text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo formatTanggal($data['tanggal'])?></p>
                            <h6 class="card-title text-truncate"><?php echo $data['detail']?>....</h6>
                            <p class="card-text price">Rp <?php echo number_format($data['harga'], 2, ',', '.') ?></p>
                            <div class="d-flex justify-content-center">
                                <a href="wisata-detail.php?nama=<?php echo $data['nama']?>" class="btn warna3 text-white">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="container text-center">
                <a class="btn btn-outline-primary mt-3 p-2 fs-5" href="wisata.php">see more</a>
            </div>
        </div>
    </div>
    <!-- footer -->
     <?php require 'footer.php'?>
     <script src="./js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                    entry.target.classList.remove('fade-out');
                } else {
                    entry.target.classList.remove('fade-in');
                    entry.target.classList.add('fade-out');
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => {
            card.classList.add('hidden');
            observer.observe(card);
        });
    });
</script>
</body>
</html>