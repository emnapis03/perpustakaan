<?php

function ambil_kategori($db)
{
    // ambil data kategori
    $query = "SELECT kembali.*,kembali.kembali_id as id_kembali, buku.buku_id ,buku.buku_judul, anggota.anggota_nama,
    (SELECT tgl_pinjam FROM pinjam JOIN kembali ON pinjam.kembali_id=kembali.kembali_id WHERE pinjam.kembali_id=id_kembali) as tgl_pinjam
    FROM kembali
    JOIN buku ON buku.buku_id = kembali.buku_id
    JOIN anggota ON anggota.anggota_id = kembali.anggota_id";
    $hasil = mysqli_query($db, $query);
    $data_kategori = array();

    while ($row = mysqli_fetch_assoc($hasil)) {
        $data_kategori[] = $row;
    }

    return $data_kategori;
}

function hitung_denda($tgl_kembali, $tgl_jatuh_tempo)
{
    if (strtotime( $tgl_kembali ) > strtotime($tgl_jatuh_tempo)) {
        $kembali = new DateTime($tgl_kembali); 
        $jatuh_tempo   = new DateTime($tgl_jatuh_tempo); 

        $selisih = $kembali->diff($jatuh_tempo);
        $selisih = $selisih->format('%d');

        $denda = 2000 * $selisih;
    } else {
        $denda = 0;
    }

    return $denda;
}

function cek_stok($db, $buku_id)
{
    $q = "SELECT buku_jumlah FROM buku WHERE buku_id = $buku_id";
    $hasil = mysqli_query($db, $q);
    $hasil = mysqli_fetch_assoc($hasil);
    $stok = $hasil['buku_jumlah'];

    return $stok;
}

function kurangi_stok($db, $buku_id)
{
    $q = "UPDATE buku SET buku_jumlah = buku_jumlah - 1 WHERE buku_id = $buku_id";
    mysqli_query($db, $q);
}

function tambah_stok($db, $buku_id)
{
    $q = "UPDATE buku SET buku_jumlah = buku_jumlah + 1 WHERE buku_id = $buku_id";
    mysqli_query($db, $q);
}
