<?php
session_start();

// ... jika belum login, alihkan ke halaman login
if (! isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}


include '../connection.php';

if(isset($_GET['cari'])){
    $kata_cari = $_GET['cari'];
    $query = "SELECT * FROM kategori where anggota_nama like '%".$kata_cari."'";
}

$query = "SELECT * FROM kategori";

$hasil = mysqli_query($db, $query);

// ... menampung semua data kategori
$data_kategori = array();

// ... tiap baris dari hasil query dikumpulkan ke $data_kategori
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_kategori[] = $row;
}


// ... lanjut di tampilan
