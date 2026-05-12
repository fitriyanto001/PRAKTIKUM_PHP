<?php
$nama_praktikum = "Dasar PHP menuju laravel";
$pertemuan = 1;
$status_aktif = true;
$nilai = 90.5;

// menampilkan data dengan echo
echo "<h1>Selamat Datang</h1>";
echo "Materi: " . $nama_praktikum . "<br>";
// titik (.) digunakan untuk menggabungkan string (konkatenasi)
echo "Pertemuan ke-$pertemuan <br>";
// variabel di dalam kutip dua ("") akan langsung diproses
echo "Nilai ambang batas: $nilai <br>";

// menampilkan struktur data dengan print_r (debugging)
echo "<pre>";
print_r("Debugging: Variable status_aktif bernilai $status_aktif");
echo "</pre>";

// operasi matematika
$angka1 = 10;
$angka2 = 5;

$tambah = $angka1 + $angka2;
$kurang = $angka1 - $angka2;
$kali = $angka1 * $angka2;
$bagi = $angka1 / $angka2;

echo "Hasil Penjumlahan: $tambah <br>";
echo "Hasil Pengurangan: $kurang <br>";
echo "Hasil Perkalian: $kali <br>";
echo "Hasil Pembagian: $bagi <br>";
?>