<?php
session_start();

// ... jika belum login, alihkan ke halaman login
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}


include '../connection.php';

if (isset($_GET['cari'])) {
    $kata_cari = $_GET['cari'];
    $query = "SELECT * FROM kategori where kategori_nama like '%" . $kata_cari . "%'";
} else {
    $query = "SELECT * FROM kategori";
}

$hasil = mysqli_query($db, $query);

// ... menampung semua data kategori
$data_kategori = array();

// ... tiap baris dari hasil query dikumpulkan ke $data_kategori
while ($row = mysqli_fetch_array($hasil)) {
    $data_kategori[] = $row;
}


// ... lanjut di tampilan

// ... ambil data dari database
// include 'proses-list-kategori.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <div class="container clearfix">
        <h1>Gudang Buku</h1>

        <?php include '../sidebar.php' ?>

        <div class="content">
            <h1>Daftar Kategori</h1>
            <div class="btn-tambah-div">
                <a href="tambah-kategori.php"><button class="btn btn-tambah">Tambah Data</button></a>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <form method="GET" action="list-kategori.php">
                        <label for="inputPassword6" class="col-form-label">Pencarian</label>
                        <input name="cari" type="text" class="form-control" aria-describedby="passwordHelpInline">
                        <br>
                        <br>
                        <button type="submit">Cari</button>
                    </form>
                </div>
                <?php if (empty($data_kategori)) : ?>
                    Tidak ada data.
                <?php else : ?>
                    <table class="data">
                        <tr>
                            <th>Kategori</th>
                            <th width="20%">Pilihan</th>
                        </tr>
                        <?php foreach ($data_kategori as $kategori) : ?>
                            <tr>
                                <td><?php echo $kategori['kategori_nama'] ?></td>
                                <td>
                                    <a href="edit-kategori.php?id_kategori=<?php echo $kategori['kategori_id']; ?>" class="btn btn-edit">Edit</a>
                                    <a href="delete-kategori.php?id_kategori=<?php echo $kategori['kategori_id']; ?>" class="btn btn-hapus" onclick="return confirm('anda yakin akan menghapus data?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                <?php endif ?>
            </div>

        </div>
</body>

</html>