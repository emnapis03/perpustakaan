<?php
include 'proses-list-pengembalian.php';

if (isset($_GET['cari'])) {
    $kata_cari = $_GET['cari'];
    $query = "SELECT * FROM kembali where kembali_id like '%" . $kata_cari . "%'";
} else {
    $query = "SELECT kembali.*,kembali.kembali_id as id_kembali, buku.buku_id ,buku.buku_judul, anggota.anggota_nama,
	(SELECT tgl_pinjam FROM pinjam JOIN kembali ON pinjam.kembali_id=kembali.kembali_id WHERE pinjam.kembali_id=id_kembali) as tgl_pinjam
    FROM kembali
    JOIN buku ON buku.buku_id = kembali.buku_id
    JOIN anggota ON anggota.anggota_id = kembali.anggota_id";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengembalian</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container clearfix">
        <h1>Gudang Buku</h1>

        <?php include '../sidebar.php' ?>
        <div class="content">
            <h1>Daftar Pengembalian</h1>
            <div class="col-auto">
                <form method="GET" action="../modul_pengembalian/list-pengembalian.php">
                    <label for="inputPassword6" class="col-form-label">Pencarian</label>
                    <input name="cari" type="text" class="form-control">
                    <br>
                    <br>
                    <button type="submit">Cari</button>
                </form>
            </div>
            <?php if (empty($data_kembali)) : ?>
            Tidak ada data.
            <?php else : ?>
            <table class="data">
                <tr>
                    <th>Buku</th>
                    <th>Nama</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th width="20%">Pilihan</th>
                </tr>

                <?php foreach ($hasil as $kembali) : ?>
                <tr>
                    <td><?php echo $kembali['buku_judul'] ?></td>
                    <td><?php echo $kembali['anggota_nama'] ?></td>
                    <td><?php echo $kembali['tgl_pinjam'] ?></td>
                    <td><?php echo $kembali['tgl_jatuh_tempo'] ?></td>
                    <td><?php echo $kembali['tgl_kembali'] ?></td>
                    <td>
                    <a href="delete-pengembalian.php?id_kembali=<?php echo $kembali['kembali_id'] ?>" onclick="return confirm('anda yakin akan menghapus data?')" class="btn btn-hapus">Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>

            </table>
            <?php endif ?>
        </div>

    </div>
</body>
</html>

