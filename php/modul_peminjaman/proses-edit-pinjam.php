<?php
session_start();
// ... jika belum login, alihkan ke halaman login
if (! isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

include '../connection.php';
include '../function.php';

$pinjam_id 			= $_POST['pinjam_id'];
$buku     			= $_POST['buku'];
$anggota  			= $_POST['anggota'];
$tgl_pinjam 		= date('Y-m-d',strtotime($_POST['tgl_pinjam']));
$tgl_jatuh_tempo    = date('Y-m-d',strtotime($_POST['tgl_jatuh_tempo']));

$stok = cek_stok($db, $buku);

if ($stok < 1) {
	$_SESSION['messages'] = '<font color="red">Stok buku sudah habis, proses edit gagal!</font>';

    header('Location: edit-pinjam.php?id_pinjam=' . $pinjam_id);
    exit();
}

// ambil data pinjam yang sudah ada
$q = "SELECT buku.buku_judul, buku.buku_id, pinjam.pinjam_id, pinjam.anggota_id FROM pinjam
			JOIN buku ON buku.buku_id=pinjam.buku_id
			WHERE (pinjam.buku_id=$buku AND pinjam.anggota_id='$anggota')";
$hasil_check = mysqli_query($db, $q);
$data = mysqli_fetch_assoc($hasil_check);

if (count($data['pinjam_id']) > 0 && $pinjam_id != $data['pinjam_id']) {
	$_SESSION['messages'] = '<font color="red">anggota dengan id '.$data['anggota_id'].' sudah meminjam buku '.$data['buku_judul'].' ini!</font>';
	
	header('Location: edit-pinjam.php?id_pinjam=' . $pinjam_id);
    exit();
}

$query = "UPDATE pinjam 
			SET 
				buku_id = '$buku', 
				anggota_id = '$anggota', 
				tgl_pinjam = '$tgl_pinjam', 
				tgl_jatuh_tempo = '$tgl_jatuh_tempo'
			WHERE
				pinjam_id = '$pinjam_id'";

$hasil = mysqli_query($db, $query);

if ($hasil == true) {

	kurangi_stok($db, $buku);
	// Mengurangi stok buku
	
	$_SESSION['messages'] = '<font color="green">Proses edit data sukses!</font>';
	header('Location: pinjam-data.php');
} else {
	$_SESSION['messages'] = '<font color="red">Proses edit gagal!</font>';
    header('Location: edit-pinjam.php?id_pinjam=' . $pinjam_id);
}
