<?php
session_start();
if (isset($_SESSION["login"])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h3 class="judul">Halaman Login</h3>

  <div class="login">
    <form form action="" method="POST" class="primary">
      <div class="form-group">
        <label for="username" class="col-sm-2 col-form-label">Usename:</label>
        <input type="text" name="username" id="usename" placeholder="Username Anda" class="form-control" required>
        <small id="emailHelp" class="form-text text-muted">Pastikan Username dan Password Anda Benar</small>
      </div>
      <div class="form-group">
        <label for="password" class="col-form-label">Password:</label>
        <input type="password" class="password form-control" name="password" id="password" required placeholder="Password" class="password">

      </div>
      <button class="btn btn-outline-primary" type="submit" name="login">Log in</button>
      <small id="emailHelp" class="form-text text-muted">belum punya akun?<a href="registrasi.php">klik disin</a>untuk membuat akun</small>
      <br>
      <h4 id="eror"></h4>
    </form>
  </div>
  <br>

  <!-- script JS -->
  <script src="bootstrap/jquery/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>
<?php

require_once 'function.php';

if (isset($_POST['login'])) {
  if (login($_POST)[0]) {
    $alasan = login($_POST)[1];
    echo "<script>
            document.getElementById('eror').innerHTML ='$alasan';</script>";
  } else {
    $_SESSION["login"] = true;
    header("Location:index.php");
  }
}
?>