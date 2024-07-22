<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM wisata a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $querykategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <title>Parawisata-Detail</title>
</head>
<style>
    form div {
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php"?>

    <div class="container mt-5">
        <h2>Perubahan Data Parawisata</h2>
        <div class="col-12 col-md-6 mt-3">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" id="nama" name="nama" value="<?php echo $data['nama']?>" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="<?php echo $data['kategori_id']?>"><?php echo $data['nama_kategori']?></option>
                            <?php 
                                while($datakategori = mysqli_fetch_array($querykategori)){
                                    echo '<option value="'.$datakategori['id'].'">'.$datakategori['nama'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal" value="<?php echo $data['tanggal'] ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="currentFoto">Foto Parawisata Sekarang</label>
                        <img src="../image/<?php echo $data['foto']?>" alt="" width="300px">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="detail" class="col-sm-2 col-form-label">Detail</label>
                    <div class="col-sm-10">
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail']?></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="ketersedian_stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <select name="ketersedian_stok" id="ketersedian_stok" class="form-select">
                            <option value="<?php echo $data['ketersedian_stok']?>"><?php echo $data['ketersedian_stok']?></option>
                            <?php 
                                if($data['ketersedian_stok'] == 'tersedia'){
                                    echo '<option value="habis">Habis</option>';
                                } else {
                                    echo '<option value="tersedia">Tersedia</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="video_url" class="col-sm-2 col-form-label">Video URL</label>
                    <div class="col-sm-10">
                        <input type="url" id="video_url" name="video_url" value="<?php echo $data['video_url'] ?>" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
                    <button type="submit" class="btn btn-danger" name="hapus"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                </div>
            </form>
            <?php 
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersedian_stok = htmlspecialchars($_POST['ketersedian_stok']);
                    $tanggal = htmlspecialchars($_POST['tanggal']);
                    $video_url = htmlspecialchars($_POST['video_url']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama == '' || $kategori == '' || $harga == '' || $tanggal == '' || $video_url == ''){
                        echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">Nama, Kategori, Harga, Tanggal, dan Video URL wajib diisi<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    } else {
                        $queryUpdate = mysqli_query($conn, "UPDATE wisata SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersedian_stok='$ketersedian_stok', tanggal='$tanggal', video_url='$video_url' WHERE id='$id'");
                        
                        if($nama_file != ''){
                            if($image_size > 50000000000){
                                echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">File tidak boleh lebih dari 100Kb<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                            } else {
                                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'){
                                    echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">File wajib bertipe png atau jpg<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                    $queryUpdate = mysqli_query($conn, "UPDATE wisata SET foto='$new_name' WHERE id='$id'");

                                    if($queryUpdate){
                                        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Data berhasil diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                        echo '<meta http-equiv="refresh" content="2; url=wisata.php"/>';
                                    }
                                }
                            }
                        } else {
                            if($queryUpdate){
                                echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Data berhasil diubah<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                echo '<meta http-equiv="refresh" content="2; url=wisata.php"/>';
                            }
                        }
                    }
                } 
                if(isset($_POST['hapus'])){
                    $querySelectFoto = mysqli_query($conn, "SELECT foto FROM wisata WHERE id='$id'");
                    $dataFoto = mysqli_fetch_array($querySelectFoto);
                    $fotoLama = $dataFoto['foto'];

                    if(file_exists("../image/" . $fotoLama)){
                        unlink("../image/" . $fotoLama);
                    }
                    
                    $queryHapus = mysqli_query($conn, "DELETE FROM wisata WHERE id='$id'");
                    if($queryHapus){
                        echo '<div class="alert alert-primary mt-3" role="alert">Data berhasil dihapus</div>';
                        echo '<meta http-equiv="refresh" content="2; url=wisata.php"/>';
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            ?>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
