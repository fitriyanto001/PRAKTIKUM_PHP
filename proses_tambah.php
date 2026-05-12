<?php
require 'koneksi.php';

// Cek apakah ada data yang dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori_id'];

    // Menggunakan Prepared Statements untuk Keamanan
    $sql = "INSERT INTO barang (nama_barang, harga, stok, kategori_id)
            VALUES (:nama, :harga, :stok, :kategori)";
    $stmt = $pdo->prepare($sql);

    // Bind parameter untuk mencegah SQL Injection
    $stmt->execute([
        ':nama' => $nama,
        ':harga' => $harga,
        ':stok' => $stok,
        ':kategori' => $kategori
    ]);

    // Redirect kembali ke halaman utama jika berhasil
    header("Location: index.php?pesan=berhasil_tambah");
    exit();
}