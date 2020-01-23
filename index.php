<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location:login.php");
}
require('function.php');
$tampil = 5;
$data = count(lihat("SELECT * FROM anggota"));
$total = ceil($data / $tampil);
//total 11, halaman=4
//aktif =2, mulai=3
//aktif=3, mulai=6
if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}
$Pawal = ($tampil * $page) - $tampil;



$hasil = lihat("SELECT*FROM anggota LIMIT $Pawal,$tampil");
if (isset($_POST["simpan"])) {
  if (tambah($_POST) > 0) {
    echo "<script>
     alert ('Data Berhasil di Tambahkan!');</script>";
    header("Location:index.php");
  } else {
    echo "<script>
    alert ('ada yang error!');</script>";
  }
}
if (isset($_POST["refresh"])) {
  header("Location:index.php");
}
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  if (hapus($id) > 0) {
    echo "<script>
      alert ('Data Berhasil di Hapus!');</script>";
    header("Location:index.php");
  } else {
    echo "<script>
      alert ('Ada yang Salah');</script>";
  }
}
if (isset($_POST["cari"])) {
  $key = $_POST["key"];
  $hasil = cari($key);
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Halaman Admin</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h1>Daftar Anggota</h1>
  <h2>HIPELMAS</h2>
  <hr>
  <div class="menu navbar ustify-content-between navbar-light bg-light">
    <form action="" method="Post" class="form-inline">
      <div class="main">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Tambah Anggota</button>
        <button name="refresh" type="submit" class="btn btn-primary">Refresh</button>
        <a href="logout.php" name="logout" class="btn btn-primary" onclick="return confirm('yakin ingin log out?')">Log Out</a>

      </div>
      <br>
      <div class="cari">
        <input type="search" class=" cari form-control mr-sm-2" placeholder="Cari" name="key" id="key">
        <button type="submit" class="btn btn-outline-info" name="cari">Cari</button>
      </div>
      <div class="navigasi">
        <?php if ($page > 1) : ?>
          <a href="?page=<?= $page - 1 ?>">&lt</a>
        <?php endif ?>

        <?PHP for ($i = 1; $i <= $total; $i++) {
          if ($i == $page) { ?>
            <a class="aktif" href="?page=<?= $i; ?>"><?= $i; ?></a>
          <?php } else { ?>
            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
        <?php }
        }
        ?>
        <?php if ($page < $total) : ?>
          <a href="?page=<?= $page + 1 ?>">&gt</a>
        <?php endif
        ?>
      </div>
    </form>
  </div>
  <div class="isi ">
    <table class="table-hover table-secondary" border="1" cellpadding="10" cellspacing="0">
      <tr class="bg-info">
        <th>No</th>
        <th>Aksi</th>
        <th>Foto</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Jurusan</th>
        <th>Perguruan Tinggi</th>
        <th>Angkatan</th>

      </tr>
      <?php
      $i = 1;
      foreach ($hasil as $a) : ?>
        <tr>
          <td><?= $i ?></td>
          <td>
            <a href="ubah.php?id=<?= $a["id"] ?>" name="edit" class="edit btn btn-sm btn-primary">Edit</a>
            <a name="hapus" class="hapus btn btn-sm btn-danger" href="index.php?id=<?= $a["id"]; ?>" onclick="return confirm('yakin ingin hapus?')">Hapus</a>
          </td>
          <td><img src="img/<?= $a["foto"] ?>" alt=""></td>
          <td><?= $a["nama"] ?></td>
          <td><?= $a["alamat"] ?></td>
          <td><?= $a["jurusan"] ?></td>
          <td><?= $a["pt"] ?></td>
          <td><?= $a["angkatan"] ?></td>

        </tr>
      <?php $i++;
      endforeach
      ?>
    </table>

    <br><br><br><br>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Anggota Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="index.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="nama" class="col-form-label">Nama:</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
                <label for="alamat" class="col-form-label">Alamat:</label>
                <input type="text" class="form-control" name="alamat" id="Alamat" required>
                <label for="jurusan" class="col-form-label">jurusan:</label>
                <input type="text" class="form-control" name="jurusan" id="jurusan" required>
                <label for="pt" class="col-form-label">Perguruan Tinggi:</label>
                <input type="text" class="form-control" name="pt" id="pt" required>
                <label for="angkatan" class="col-form-label">Angkatan:</label>
                <input type="text" class="form-control" name="angkatan" id="angkatan" required>
                <label for="foto">Foto:</label><br>
                <input id="uploadFile" placeholder="Pilih File..." disabled="disabled" />
                <div class="fileUpload btn btn-sm btn-primary">
                  <span>Upload</span>
                  <input id="uploadBtn" type="file" class="upload" name="foto" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.getElementById("uploadBtn").onchange = function() {
        document.getElementById("uploadFile").value = this.value;
      };
    </script>
    <script src="bootstrap/jquery/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>