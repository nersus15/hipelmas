<?php
$conn = mysqli_connect("localhost", "root", "", "hipelmas");
//fungsi menampilkan data
function lihat($query)
{
   global $conn;
   $result = mysqli_query($conn, $query);
   $hasil = [];
   while ($anggota = mysqli_fetch_assoc($result)) {
      $hasil[] = $anggota;
   }
   return $hasil;
}
//ahir fungsi menampilkan data

//fungsi menambahkan data
function tambah($data)
{
   global $conn;
   $nama = Htmlspecialchars($data["nama"]);
   $alamat = Htmlspecialchars($data["alamat"]);
   $jurusan = Htmlspecialchars($data["jurusan"]);
   $pt = Htmlspecialchars($data["pt"]);
   $angkatan = Htmlspecialchars($data["angkatan"]);
   // 
   $foto = upload();
   if (!$foto) {
      return false;
   } else {
      // $query= "INSERT INTO anggota (nama,alamat,jurusan,pt,angkatan,foto) value (,$nama','$alamat','$jurusan','$pt','$angkatan','$foto')";
      $query = "INSERT INTO anggota (nama, alamat, jurusan, pt,angkatan, foto) value ( '$nama','$alamat','$jurusan','$pt','$angkatan','$foto')";
      mysqli_query($conn, $query);
      return mysqli_affected_rows($conn);
   }
}
//ahit fungsi tambah

//fungsi hapus
function hapus($id)
{
   global $conn;
   $query = "DELETE FROM anggota WHERE anggota.id=$id";
   mysqli_query($conn, $query);
   return mysqli_affected_rows($conn);
}
//ahir fungsi hapus

//fungsi edit
function ubah($data)
{
   // var_dump($data);
   // var_dump($_FILES);
   // die;
   global $conn;
   $id = $data['id'];
   $nama = $data['nama'];
   $alamat = $data['alamat'];
   $jurusan = $data['jurusan'];
   $pt = $data['pt'];
   $angkatan = $data['angkatan'];
   $fotoL = $data["fotoL"];

   if ($_FILES['foto']['error'] == 4) {
      $foto = $fotoL;
   } else {
      $foto = upload();
   }
   if (!$foto) {
      return false;
   } else {
      $query = "UPDATE anggota SET nama='$nama',alamat='$alamat',jurusan='$jurusan',pt='$pt',angkatan='$angkatan',foto='$foto'
      where id='$id'";
      mysqli_query($conn, $query);
      return mysqli_affected_rows($conn);
   }
}
//ahir fungsi edit


//fungsi cari
function cari($key)
{
   global $conn;

   $query = "SELECT*FROM anggota  WHERE id='$key'or nama like '%$key%'or alamat like '%$key%' or jurusan like '%$key%'or pt like '%$key%'or angkatan like '%$key%'";


   return mysqli_query($conn, $query);
}
// ahir fungsi cari

//fungsi upload
function upload()
{
   $namaF = $_FILES['foto']['name'];
   $ukuranF = $_FILES['foto']['size'];
   $error = $_FILES['foto']['error'];
   $tmp = $_FILES['foto']['tmp_name'];
   if ($error == 4) {
      echo "<script> alert('Anda Belum Upload Gambar/Foto');</script>";
      return false;
   }
   $extensi = ['jpg', 'jpeg', 'png'];
   $extensiU = explode('.', $namaF);
   $extensiU = strtolower(end($extensiU));
   if (!in_array($extensiU, $extensi)) {
      echo "<script> alert('Pilih Gambar yang sesuai, jpg/jpeg/png');</script>";
      return false;
   }
   if ($ukuranF > 1000000) {
      echo "<script> alert('Gambar yang anda pilih terlalu besar max 1Mb');</script>";
      return false;
   }
   $fix = uniqid();
   $fix .= ".";
   $fix .= $extensiU;
   move_uploaded_file($tmp, 'img/' . $fix);
   return $fix;
}
// ahir fungsi upload

// fungsi regstrasi

function register($user)
{
   global $conn;
   $username = $user["username"];
   $password = $user["password"];
   $password2 = $user["password2"];
   // var_dump($username);
   // var_dump($password);
   // var_dump($password2);die;
   $cekUser = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");
   if (mysqli_fetch_assoc($cekUser)) {
      echo "<script>alert ('Username Sudah Dipakai!');</script>";
      return false;
   }
   if ($password !== $password2) {
      echo "<script>alert ('Password tidak sesuai');</script>";
      return false;
   }

   $password = password_hash($password, PASSWORD_DEFAULT);
   $id = uniqid();
   $query = "INSERT INTO user VALUES('$id','$username','$password')";
   mysqli_query($conn, $query);
   return mysqli_affected_rows($conn);
}
//ahir fungsi registrasi

//fungsi login

function login($data)
{
   global $conn;
   $username = $data["username"];
   $password = $data["password"];
   $cekUser = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

   if (mysqli_num_rows($cekUser) === 1) {
      $akun = mysqli_fetch_assoc($cekUser);
      if (!password_verify($password, $akun["password"])) {
         $error = [true, "Password yang Anda Masukkan Salah"];
         return $error;
      }
   } else {
      $error = [true, "Username Tidak Terdaftar"];
      return $error;
   }
}
