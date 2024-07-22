<?php
    session_start();
    require "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css-boostrap/bootstrap.min.css" rel="stylesheet" />
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
</head>
<style>
.main {
    height: 100vh;
}

.login-box {
    width: 500px;
    height: 300px;
    box-sizing: border-box;
    border-radius: 10px;
}

</style>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
        <form action="" method="post">
            <div>
                <label for="username">username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div>
                <label for="password">password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="d-flex grid gap-3">
            <button  class="btn btn-success form-control mt-3" type="submit" name="loginbtn"> Login </button>
            <button class="btn btn-primary form-control mt-3" type="submit"> Register </button>
            </div>
    </div>
        </form>
        <div class="mt-3" style="width: 500px">
        <?php
            if(isset($_POST['loginbtn'])){
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                
                $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);
                
                if($countdata>0){
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: ../adminpanel');
                    }
                    else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                        password salah
                        </div>
                    <?php
                    }
                }
                else{
                    ?>
                    <div class="alert alert-warning" role="alert">
                    akun tidak tersedia
                    </div>  
                    <?php
                }
            }
        ?>
    </div>
    </div> 
</body>
</html>