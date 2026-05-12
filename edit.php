<?php
require 'koneksi.php';
$id = $_GET['id'];

// 1. Ambil data barang yang akan diedit
$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$barang = $stmt->fetch();

if (!$barang) {
    die("Data tidak ditemukan!");
}

// 2. Ambil semua kategori untuk isi dropdown (Integrasi Poin 2)
$stmt_kat = $pdo->query("SELECT * FROM kategori");
$daftar_kategori = $stmt_kat->fetchAll();
?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'harga_negatif'): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Harga tidak boleh lebih kecil dari 0.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="proses_edit.php" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?= $barang['id']; ?>">

    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control"
            value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="id_kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($daftar_kategori as $kat): ?>
                <option value="<?= $kat['id']; ?>" 
                    <?= ($kat['id'] == $barang['kategori_id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($kat['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control"
            value="<?= $barang['harga']; ?>" required>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i> Update Data
    </button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>