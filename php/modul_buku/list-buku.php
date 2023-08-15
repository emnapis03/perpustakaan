<?php

// ... ambil data dari database
include 'proses-list-buku.php';

if (isset($_GET['cari'])) {
    $kata_cari = $_GET['cari'];
    $query = "SELECT buku.buku_id, buku.buku_judul, buku.buku_jumlah, buku.buku_deskripsi, buku.buku_cover, kategori.kategori_nama
    from buku join kategori on buku.kategori_id = kategori.kategori_id where buku_judul like '%" . $kata_cari . "%'";
} else {
    $query = "SELECT buku.buku_id, buku.buku_judul, buku.buku_jumlah, buku.buku_deskripsi, buku.buku_cover, kategori.kategori_nama
    from buku
    join kategori on buku.kategori_id = kategori.kategori_id";
}

$hasil = mysqli_query($db, $query);

// ... menampung semua data buku
$data_buku = array();

// ... tiap baris dari hasil query dikumpulkan ke $data_buku
while ($row = mysqli_fetch_array($hasil)) {
    $data_buku[] = $row;
}
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
            <h1>Daftar Buku</h1>
            <div class="btn-tambah-div">
                <a href="tambah-buku.php"><button class="btn btn-tambah">Tambah Data</button></a>
            </div>
            <div class="col-auto">
                <form method="GET" action="list-buku.php">
                    <label for="inputPassword6" class="col-form-label">Pencarian</label>
                    <input name="cari" type="text" class="form-control" aria-describedby="passwordHelpInline">
                    <br>
                    <br>
                    <button type="submit">Cari</button>
                </form>
            </div>
            <?php if (empty($data_buku)) : ?>
                Tidak ada data.
            <?php else : ?>
                <table class="data">
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Penerbit</th>
                        <th width="20%">Pilihan</th>
                    </tr>
                    <?php foreach ($data_buku as $buku) : ?>
                        <tr>
                            <td><?php echo $buku['buku_judul'] ?></td>
                            <td><?php echo $buku['kategori_nama'] ?></td>
                            <td><?php echo $buku['buku_deskripsi'] ?></td>
                            <td><?php echo $buku['buku_jumlah'] ?></td>
                            <td><?php echo $buku['buku_cover'] ?></td>
                            <td>
                                <a href="edit-buku.php?id_buku=<?php echo $buku['buku_id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="delete-buku.php?id_buku=<?php echo $buku['buku_id']; ?>" class="btn btn-hapus" onclick="return confirm('anda yakin akan menghapus data?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>

    </div>
</body>

</html>