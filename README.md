# workshop-jepara #

## Materi untuk workshop, tanggal **19-20 Maret 2016** ##

----------
#### UAS Teknologi Komputer ####
Hasil dari diskusi untuk workshop, sebagai berikut :

Kasus :
-------
> **Gudang Buku**, *mengapa?*
> Dibanding ecommerce dan artikel lebih lengkap.
> **(Mencapai Goals)**

Goals :
-------
1. Relasi Data
2. Upload Foto
3. CRUD
4. **Input** (data master & transaksi) **Proses** (telat kembali, denda) **Output** (tau jumlah yg telat/denda)
5. Autentikasi (login)

Tabel database **`siperpus`** :
----------------
1. Master : <br />
  1.a. **buku** <br />
<table>
  <tr>
    <th>field</th>
    <th>type</th>
  </tr>
  <tr>
    <td>buku_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>judul</td>
    <td>`varchar`</td>
  </tr>
  <tr>
    <td>kategori</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>deskripsi</td>
    <td>`text`</td>
  </tr>
  <tr>
    <td>jumlah</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>cover</td>
    <td>`varchar`</td>
  </tr>
</table>
1.b. **kategori** <br />
<table>
  <tr>
    <th>field</th>
    <th>type</th>
  </tr>
  <tr>
    <td>kategori_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>kategori</td>
    <td>`varchar`</td>
  </tr>
</table>
1.c. **anggota** <br />
<table>
  <tr>
    <th>field</th>
    <th>type</th>
  </tr>
  <tr>
    <td>anggota_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>nama</td>
    <td>`varchar`</td>
  </tr>
  <tr>
    <td>alamat</td>
    <td>`text`</td>
  </tr>
  <tr>
    <td>jk</td>
    <td>`enum(L,P)`</td>
  </tr>
  <tr>
    <td>telp</td>
    <td>`varchar`</td>
  </tr>
</table>
1.d. **petugas** <br />
<table>
  <tr>
    <th>field</th>
    <th>type</th>
  </tr>
  <tr>
    <td>petugas_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>nama</td>
    <td>`varchar`</td>
  </tr>
  <tr>
    <td>username</td>
    <td>`varchar`</td>
  </tr>
  <tr>
    <td>password</td>
    <td>`varchar`</td>
  </tr>
</table>
2. Transaksi : <br />
2.a. **pinjam** <br />
<table>
  <tr>
    <th>field</th>
    <th>type</th>
  </tr>
  <tr>
    <td>pinjam_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>buku_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>anggota_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>tgl_pinjam</td>
    <td>`date`</td>
  </tr>
  <tr>
    <td>tgl_jatuh_tempo</td>
    <td>`date`</td>
  </tr>
</table>
2.b. **kembali** <br />
<table>
  <tr>
    <th>field</th>
    <th>type</th>
  </tr>
  <tr>
    <td>kembali_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>pinjam_id</td>
    <td>`int`</td>
  </tr>
  <tr>
    <td>tgl_kembali</td>
    <td>`date`</td>
  </tr>
  <tr>
    <td>denda</td>
    <td>`double`</td>
  </tr>
</table>

### MATERI ###

--------------

1. DATABASE <br />
1.a. Pengantar & Referensi Belajar <br />
1.b. Create tabel 6 <br />
1.c. Penjelasan **`INSERT, UPDATE, DELETE, SELECT`** <br />
2. HTML & CSS <br />
2.a. HTML <br />
2.a.1). Tag <br />
2.a.2). Attribute <br />
2.a.3). Form <br />
Termsuk validasi & referensi belajar detailnya <br />
2.a. CSS <br />
2.a.1). Pengantar <br />
2.a.1). `Struktur syntax` <br />
2.a.2). `Class` <br />
2.a.3). `Id` <br />
2.a.4). `Property` <br />
Referensi belajar detailnya <br />
Kedua bahasan di atas, membuat layout untuk kasus perpus (form buku & view data buku) <br />
3. PHP <br />
3.a.pengantar & contoh implementasi <br />
3.b. Percabangan `(If)` <br />
3.b.1). Konek db <br />
3.b.2). Login <br />
3.b.3). Upload <br />
3.c. Perulangan `(Looping)` <br />
3.c.1). Menampilkan data dari tabel database <br />
3.d. Fungsi `(Function)` <br />
3.d.1). Hitung telat brp hari, denda brp <br />
4. Modul : <br />
4.a. Instalasi web server & tools <br />
4.b. Source code & penjelasan poin tertentu <br />
4.c. penekanan bukan pada web desain <br />
4.d. Daftar referensi belajar <br />
