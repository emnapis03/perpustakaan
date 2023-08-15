<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Anggota</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container clearfix">
        <h1>Gudang Buku</h1>

        <?php include '../sidebar.php' ?>

        <div class="content">
            <h3>Tambah Data Anggota</h3>
            <form method="post" action="proses-tambah-anggota.php">
                <p>Nama</p>
                <p><input type="text" name="nama"></p>
                <p>Alamat</p>
                <p><input type="text" name="alamat"></p>
                <p>Jenis Kelamin</p>
                <p>
                    <select name="jk">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </p>
                <p>Telepon</p>
                <p><input type="text" name="no_telepon"></p>
                <p>
                    <input type="submit" class="btn btn-submit" value="Simpan">
                    <input type="reset" class="btn btn-submit" value="Batal" onclick="self.history.back();">
                </p>
            </form>
        </div>

    </div>
</body>
</html>
