<?php
require 'koneksi.php';
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$barang = $stmt->fetch();

if (!$barang) {
    die("Data tidak ditemukan!");
}

$stmt_kat = $pdo->query("SELECT * FROM kategori");
$daftar_kategori = $stmt_kat->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Barang - SB Admin 2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="css/edit.css">
</head>
<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Toko <sup>SB</sup></div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="edit.php?id=<?= $barang['id']; ?>">
                <i class="fas fa-fw fa-edit"></i>
                <span>Edit Barang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tambah.php">
                <i class="fas fa-fw fa-plus"></i>
                <span>Tambah Barang</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cetak.php" target="_blank">
                <i class="fas fa-fw fa-print"></i>
                <span>Cetak PDF</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="index.php">
                                <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                Dashboard
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Barang</h1>
                    <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
                </div>

                <?php if (isset($_GET['error']) && $_GET['error'] === 'harga_negatif'): ?>
                    <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
                        <strong>Error!</strong> Harga tidak boleh lebih kecil dari 0.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endif; ?>

                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="card form-card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-white">Form Edit Barang</h6>
                            </div>
                            <div class="card-body">
                                <form action="proses_edit.php" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" value="<?= $barang['id']; ?>">

                                    <div class="mb-3">
                                        <label class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($barang['nama_barang']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="id_kategori" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php foreach ($daftar_kategori as $kat): ?>
                                                <option value="<?= $kat['id']; ?>" <?= ($kat['id'] == $barang['kategori_id']) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($kat['nama_kategori']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Harga</label>
                                        <input type="number" name="harga" class="form-control" value="<?= $barang['harga']; ?>" required>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                        <button type="submit" class="btn btn-save btn-lg">
                                            <i class="fas fa-save"></i> Update Data
                                        </button>
                                        <a href="index.php" class="btn btn-cancel btn-lg">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>© <?= date('Y'); ?> Toko SB Admin 2</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.3/js/sb-admin-2.min.js"></script>
</body>
</html>
