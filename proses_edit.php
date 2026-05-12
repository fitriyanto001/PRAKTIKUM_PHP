<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT') {
    $id = $_POST['id'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];

    if ($harga < 0) {
        header("Location: edit.php?id=$id&error=harga_negatif");
        exit; // Pastikan skrip berhenti di sini
    }
    // ----------------------------------

    $sql = "UPDATE barang SET nama_barang = ?, harga = ? WHERE id = ?";
    $pdo->prepare($sql)->execute([$nama, $harga, $id]);

    header("Location: index.php?pesan=berhasil_update");

    $sql = "UPDATE barang SET nama_barang = ?, harga = ? WHERE id = ?";
    $pdo->prepare($sql)->execute([$nama, $harga, $id]);
}