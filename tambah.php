<?php
require 'koneksi.php';

// Ambil data kategori
$stmt = $pdo->query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Form Tambah Barang</h4>
                </div>

                <div class="card-body">
                    <form action="proses_tambah.php" method="POST">

                    <!-- mb margin bottom mt margin top -->
                        
                        <div class="mb-3 mt-2">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>

                        <div class="mb-3 mt-2">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>

                        <div class="mb-3 mt-2">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>

                        <!-- Dropdown Kategori -->
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php while($row = $stmt->fetch()): ?>
                                    <option value="<?= $row['id']; ?>">
                                        <?= htmlspecialchars($row['nama_kategori']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                            <a href="index.php" class="btn btn-secondary mt-2">Kembali</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>