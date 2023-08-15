<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$database = "db_perpus";

$db = mysqli_connect($host, $user, $pass, $database) or die("gagal koneksi ke database");

//jika belum login, alihkan ke login
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Petugas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container clearfix">
        <h1>Gudang Buku</h1>
        
        <div class="sidebar">
            <ul>
                <li><a href="modul_kategori/list-kategori.php">Data Kategori</a></li>
                <li><a href="modul_buku/list-buku.php">Data Buku</a></li>
                <li><a href="modul_anggota/list-anggota.php">Data Anggota</a></li>
                <li><a href="modul_peminjaman/pinjam-data.php">Peminjaman</a></li>
                <li><a href="modul_pengembalian/list-pengembalian.php">Pengembalian</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
        <div class="content">
            <h1>Selamat datang, <?php echo $_SESSION['user']['petugas_nama']; ?></h1>
        </div>
    </div>
</body>

</html>