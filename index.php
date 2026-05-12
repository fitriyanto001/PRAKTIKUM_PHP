<?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data telah **<?= htmlspecialchars($_GET['pesan']); ?>**!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php
require 'koneksi.php';

// Menyiapkan Query
$stmt = $pdo->query("SELECT barang.*, kategori.nama_kategori
                     FROM barang
                     JOIN kategori ON barang.kategori_id = kategori.id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

    <h2 class="mb-4">Data Barang Toko</h2>

    <!-- Tombol Tambah -->
        <div class="mb-3">
            <a href="tambah.php" class="btn btn-primary">Tambah Barang</a>
            <a href="cetak.php" target="_blank" class="btn btn-success">
                <i class="bi bi-printer"></i> Cetak PDF </a>
        </div>

    <div class="card shadow">
        <div class="card-body">



            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $stmt->fetch()):
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <?php
                            if ($row['stok'] < 5) {
                                echo "<span class='text-danger'>Hampir Habis</span>";
                            } elseif ($row['stok'] > 5) {
                                echo "<span class='text-success'>Tersedia</span>";
                            } else {
                                echo "<span class='text-danger'>Stok Habis</span>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm" title="Edit Data">
                            <i class="fas fa-edit"></i>
                            </a>

                             <form action="proses_hapus.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
        
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Data">
                            <i class="fas fa-trash-alt"></i>
                            </button>
                            </form>
                        </td>                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>