<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// ... jika belum login, alihkan ke halaman login
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

include '../connection.php';

if (isset($_GET['cari'])) {
    $kata_cari = $_GET['cari'];
    $query = "SELECT buku.*,buku.buku_id as id_buku, buku.buku_judul, buku.buku_jumlah, buku.buku_deskripsi, buku.buku_cover, kategori.kategori_nama
    (SELECT kategori_nama FROM kategori JOIN BUKU ON kategori.buku_id=buku.buku_id WHERE kategori.buku_id=id_buku) as kategori_nama
    FROM buku
    JOIN kategori ON buku.kategori_id = kategori.kategori_id like '%" . $kata_cari . "%'";
}

$query = "SELECT buku.*, kategori.kategori_nama
    FROM buku
    JOIN kategori
    ON buku.kategori_id = kategori.kategori_id";


$hasil = mysqli_query($db, $query);
mysqli_connect_error();
// ... menampung semua data kategori
$data_buku = array();

// ... tiap baris dari hasil query dikumpulkan ke $data_buku
while ($row = mysqli_fetch_assoc($hasil)) {
    $data_buku[] = $row;
}

// ... lanjut di tampilan
