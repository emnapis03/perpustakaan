<?php
session_start();
// ... jika belum login, alihkan ke halaman login
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

include '../connection.php';
include '../function.php';

if (isset($_GET['cari'])) {
    $kata_cari = $_GET['cari'];
    $query = "SELECT * FROM kembali where tgl_kembali like '%" . $kata_cari . "%'";
} else {
    $query = "SELECT kembali.*,kembali.kembali_id as id_kembali, buku.buku_id ,buku.buku_judul, anggota.anggota_nama,
	(SELECT tgl_pinjam FROM pinjam JOIN kembali ON pinjam.kembali_id=kembali.kembali_id WHERE pinjam.kembali_id=id_kembali) as tgl_pinjam
    FROM kembali
    JOIN buku ON buku.buku_id = kembali.buku_id
    JOIN anggota ON anggota.anggota_id = kembali.anggota_id";
}

$tgl_kembali = $_POST['tgl_kembali'];
$denda = $_POST['denda'];
$pinjam_id = $_POST['pinjam_id'];

$query = "INSERT INTO kembali (pinjam_id, tgl_kembali, denda) 
    VALUES ($pinjam_id, '$tgl_kembali', $denda)";

$hasil = mysqli_query($db, $query);
if ($hasil == true) {
    // ambil buku_id berdasarkan pinjam_id
    $q = "SELECT kembali.*,kembali.kembali_id as id_kembali, buku.buku_id ,buku.buku_judul, anggota.anggota_nama,
	(SELECT tgl_pinjam FROM pinjam JOIN kembali ON pinjam.kembali_id=kembali.kembali_id WHERE pinjam.kembali_id=id_kembali) as tgl_pinjam
    FROM kembali
    JOIN buku ON buku.buku_id = kembali.buku_id
    JOIN anggota ON anggota.anggota_id = kembali.anggota_id";
    $hasil = mysqli_query($db, $q);
    $hasil = mysqli_fetch_assoc($hasil);
    $buku_id = $hasil['buku_id'];

    tambah_stok($db, $buku_id);
    // tambah stok

    $_SESSION['messages'] = '<font color="green">Pengembalian buku sukses!</font>';
    header('Location: ../modul_peminjaman/pinjam-data.php');
} else {
    header('Location: pengembalian.php?id_pinjam=' . $pinjam_id);
}
