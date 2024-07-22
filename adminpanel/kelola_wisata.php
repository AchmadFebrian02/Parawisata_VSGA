<?php
require "session.php";
require "../koneksi.php";

$querywisata = mysqli_query($conn, "SELECT * FROM wisata");
$jumlahwisata = mysqli_num_rows($querywisata);

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10){
    $characters = '123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"> 
    <title>Kelola Wisata</title>
</head>

<style>
    form div{
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php"?>
    <div class="container mt-5">
        <div class="my-5 col-12 col-md-6">
        <h2>Tambahkan List Data Wisata</h2> 
        <form action="" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select name="kategori" id="kategori" class="form-select" placeholder="pilih salah satu" required>
                        <option value="">pilih salah satu</option>
                        <?php 
                            while($data=mysqli_fetch_array($querykategori)){
                        ?>
                        <option value="<?php echo $data['id'];?>"><?php echo $data['nama']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="harga">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="video_url" class="col-sm-2 col-form-label">Video URL</label>
                <div class="col-sm-10">
                    <input type="url" id="video_url" name="video_url" class="form-control" autocomplete="off" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="detail" class="col-sm-2 col-form-label">Detail</label>
                <div class="col-sm-10">
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div> 
            </div>

            <div class="mb-3 row">
                <label for="ketersedian_stok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <select name="ketersedian_stok" id="ketersedian_stok" class="form-select">
                        <option value="tersedia">tersedia</option>
                        <option value="habis">kosong</option>
                    </select>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary" name="simpan"> <i class="fa fa-plus" aria-hidden="true"></i> Tambahkan</button>
                <a href="./wisata.php" type="button" class="btn btn-danger"> <i class="fa fa-reply" aria-hidden="true"></i> Batal</a>
            </div>
        </form>
        <?php 
            if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersedian_stok = htmlspecialchars($_POST['ketersedian_stok']);
                $tanggal = htmlspecialchars($_POST['tanggal']); // Ambil input tanggal
                $video_url = htmlspecialchars($_POST['video_url']); // Ambil input video_url

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if($nama=='' || $kategori=='' || $harga=='' || $tanggal=='' || $video_url==''){
                    ?>
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    Nama, Kategori, Harga, Tanggal dan Video URL wajib di isi
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    <?php
                }
                else{
                    if($nama_file!=''){
                        if($image_size > 50000000000){
                    ?>
                             <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                file Tidak boleh lebih dari 100Kb
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                        }
                        else{
                            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg')
                            {
                            ?>
                                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                    File wajib bertipe png atau jpg
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                            }
                            else{
                                move_uploaded_file($_FILES["foto"]["tmp_name"],
                                $target_dir . $new_name);
                            }
                        }
                    }
                    // query insert
                    $queryTambah = mysqli_query($conn, "INSERT INTO wisata (kategori_id, nama, harga, foto, detail, ketersedian_stok, tanggal, video_url) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersedian_stok', '$tanggal', '$video_url')");

                    if($queryTambah){
                        ?>
                         <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Wisata Berhasil Disimpan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <meta http-equiv="refresh" content="2; url=wisata.php"/>
                        <?php
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
            }
        ?>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
