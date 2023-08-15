<?php
include '../modul_kategori/proses-list-kategori.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

$id_buku = $_GET['id_buku'];
$query = "SELECT buku.*, kategori.kategori_id
    FROM buku
    JOIN kategori
    ON buku.kategori_id = kategori.kategori_id
    WHERE buku.buku_id = $id_buku";
$hasil = mysqli_query($db, $query);
$data_buku = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Buku</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container clearfix">
        <h1>Gudang Buku</h1>

        <?php include '../sidebar.php' ?>

        <div class="content">
            <h3>Tambah Data Buku</h3>
            <form method="post" action="proses-edit-buku.php" enctype="multipart/form-data">
                <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>">
                <p>Judul</p>
                <p><input type="text" name="judul" value="<?php echo $data_buku['buku_judul'] ?>"></p>

                <p>Kategori</p>
                <p>
                	<select name="kategori">
                        <?php foreach ($data_kategori as $kategori) : ?>
                            <?php
                            if ($data_buku['kategori_id'] == $kategori['kategori_id']) {
                                $selected = "selected";
                            } else {
                                $selected = null;
                            }
                            ?>
                            <option value="<?php echo $kategori['kategori_id'] ?>" <?php echo $selected ?>><?php echo $kategori['kategori_nama'] ?></option>
                        <?php endforeach ?>
                	</select>
                </p>

                <p>Pengarang</p>
                <p><textarea name="pengarang"><?php echo $data_buku['buku_deskripsi'] ?></textarea></p>

                <p>Tahun</p>
                <p><input type="number" name="tahun" value="<?php echo $data_buku['buku_jumlah'] ?>"></p>

                <p>Penerbit</p>
                <p><textarea name="pengarang"><?php echo $data_buku['buku_cover'] ?></textarea></p>

                <p><input type="submit" class="btn btn-submit" value="Simpan"></p>
            </form>
        </div>

    </div>
</body>
</html>
