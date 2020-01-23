<?php
require_once('function.php');
if (isset($_GET['id'])) {
  $id = $_GET["id"];
  $data = lihat("SELECT * FROM anggota WHERE id=$id");
  $id = $data[0]["id"];
  $nama = $data[0]["nama"];
  $alamat = $data[0]["alamat"];
  $jurusan = $data[0]["jurusan"];
  $pt = $data[0]["pt"];
  $angkatan = $data[0]["angkatan"];
  $foto = $data[0]["foto"];
} else {
  $id = "";
  $nama = "";
  $alamat = "";
  $jurusan = "";
  $pt = "";
  $angkatan = "";
  $foto = "";
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Rubah Data</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rubah Data Anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="ubah.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input type="hidden" name="fotoL" value="<?= $foto ?>">
              <input type="hidden" name="id" value="<?= $id; ?>">
              <label for="nama" class="col-form-label">Nama:</label>
              <input value="<?= $nama ?>" type="text" class="form-control" name="nama" id="nama" required>
              <label for="alamat" class="col-form-label">Alamat:</label>
              <input value="<?= $alamat ?>" type="text" class="form-control" name="alamat" id="Alamat" required>
              <label for="jurusan" class="col-form-label">jurusan:</label>
              <input value="<?= $jurusan ?>" type="text" class="form-control" name="jurusan" id="jurusan" required>
              <label for="pt" class="col-form-label">Perguruan Tinggi:</label>
              <input value="<?= $pt ?>" type="text" class="form-control" name="pt" id="pt" required>
              <label for="angkatan" class="col-form-label">Angkatan:</label>
              <input value="<?= $angkatan ?>" type="text" class="form-control" name="angkatan" id="angkatan" required>
              <label for="foto">Foto:</label><br>
              <img src="img/<?= $foto ?>" alt="">
              <input id="uploadFile" placeholder="Pilih File..." disabled="disabled" />
              <div class="fileUpload btn btn-sm btn-primary">
                <span>Upload</span>
                <input id="uploadBtn" type="file" class="upload" name="foto" />
              </div>
            </div>
            <div class="modal-footer">
              <a class="btn btn-secondary" data-dismiss="modal" href="index.php">Close</a>
              <button type="submit" class="btn btn-primary" name="subah">Simpan Pembaruan</button>
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
<?php
if (isset($_POST["subah"])) {
  if (ubah($_POST) > 0) {
    echo "<script> alert('Berhasil Dirubah!');</script>";
  } else {
    echo "<script> alert('Ada yang Salah!');</script>";
  }
}
?>