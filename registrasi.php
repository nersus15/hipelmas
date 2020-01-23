<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location:index.php");
}
require 'function.php';
if (isset($_POST['register'])) {

    if (register($_POST) > 0) {
        echo "<script>alert('Registrasi Berhasil');</script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registrasi</title>
    <style>
        label {
            display: block;
        }

        .content {
            margin: 5% 25%;
        }
    </style>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <h3>Halaman Registrasi</h3>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Usename:</label>
                        <input type="text" name="username" id="usename" placeholder="Username Baru" class="form-control username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Password Baru" class="form-control password">
                    </div>
                    <div class="form-group">
                        <label for="password2">Konfirmasi Password:</label>
                        <input class="form-control" type="password" name="password2" id="password2" placeholder="Ulangi Password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-outline-success" type="submit" name="register">Sign Up</button>
                        <small id="emailHelp" class="form-text text-muted"><a href="login.php">klik disin</a>untuk Log in</small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>