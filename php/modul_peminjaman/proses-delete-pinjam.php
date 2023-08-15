<?php
session_start();

include '../connection.php';
include '../function.php';

$id_pinjam = $_GET['id_pinjam'];
$status    = $_GET['status'];
$buku_id   = $_GET['buku_id'];

// cek stok buku
$stok_buku = cek_stok($db, $buku_id);

if ($stok_buku < 1) {
	$_SESSION['messages'] = '<font color="red">Hapus data gagal!</font>';
    header('Location: pinjam-data.php');
    exit();
}

// Check status, jika pinjam maka data stok buku jumlahkan 1
if ($status == 'pinjam') {	
	tambah_stok($db, $buku_id);
}

$query = "DELETE FROM pinjam WHERE pinjam_id = $id_pinjam";
$hasil = mysqli_query($db, $query);

if ($hasil == true) {
	$_SESSION['messages'] = '<font color="green">Hapus data sukses!</font>';
    header('location: pinjam-data.php');
} else {
	$_SESSION['messages'] = '<font color="red">Hapus data gagal!</font>';
    header('location: pinjam-data.php');
}
