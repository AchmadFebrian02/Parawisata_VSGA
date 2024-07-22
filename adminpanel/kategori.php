<?php
    require "session.php";
    
    require "../koneksi.php";
    
    $querykategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahkategori = mysqli_num_rows($querykategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../fontawesome/css/font-awesome.min.css"> 
    <title>kategori</title>
</head>
<style>
    .no-decoration{
        text-decoration: none;
    }
</style>
<body>
<?php require "navbar.php"?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/" class="no-decoration text-muted"><i class="fa fa-home" aria-hidden="true"> home</i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                kategori
                </li>
            </ol>
        </nav>
    <div class="my-5 col-12 col-md-6">
        <h2>Tambahkan List kategori</h2>
        <form action="" method="post">
            <div>
                <label for="kategori" class="mb-2">kategori :</label>
                <input type="text" id="kategori" name="kategori" placeholder="Input nama kategori" class="form-control">
            <div class="mt-3">
                <button class="btn btn-primary" type="submit" name="simpan_kategori">
                <i class="fa fa-plus" aria-hidden="true"></i> Tambahkan data
                </button>
            </div>
            </div>
        </form>
        <?php
            if(isset($_POST['simpan_kategori'])){
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryExist = mysqli_query($conn,"SELECT nama FROM kategori WHERE nama='$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                if ($jumlahDataKategoriBaru > 0){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">kategori Sudah ada
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                }
                else{
                    $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                    if($querySimpan){
                        ?>
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Kategori Berhasil Disimpan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <meta http-equiv="refresh" content="2; url=kategori.php"/>
                        <?php
                    }
                };
            }
        ?>

   
    </div>
        <div class="mt-3">
            <h2>list kategori</h2>
            <div class="table-responsive mt-2 center-table">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        if($jumlahkategori==0){
                        ?>
                            <tr>
                                <td colspan=3 class="text-center">Data kategori Tidak tersedia</td>
                            </tr>
                        <?php
                        } 
                        else{
                            $jumlah = 1;
                            while($data=mysqli_fetch_array($querykategori)){

                     
                            ?>
                                <tr>
                                    <td class="text-center align-middle"> <?php echo $jumlah; ?></td>
                                    <td class="align-middle"> <?php echo $data['nama']?></td>
                                    <td class="text-center align-middle"><a href="kategori-detail.php?p=<?php echo $data['id']?>" type="button" class="btn btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i>
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