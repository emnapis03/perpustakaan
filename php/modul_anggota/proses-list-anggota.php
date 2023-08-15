<?php
if (session_status()!=PHP_SESSION_ACTIVE) {
	session_start();
}

// ... jika belum login, alihkan ke halaman login
if (! isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}


include '../connection.php';

if(isset($_GET['cari'])){
    $kata_cari = $_GET['cari'];
    $query = "SELECT * FROM anggota where anggota_nama like '%".$kata_cari."'";
}

$query = "SELECT * FROM anggota";

$hasil = mysqli_query($db, $query);

// ... menampung semua data kategori
$data_anggota = array();

// ... tiap baris dari hasil query dikumpulkan ke $data_anggota
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_anggota[] = $row;
}


// ... lanjut di tampilan
