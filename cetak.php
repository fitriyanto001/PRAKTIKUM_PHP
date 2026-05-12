<?php
require 'vendor/autoload.php'; 
require 'koneksi.php';

use Spipu\Html2Pdf\Html2Pdf;

$stmt = $pdo->query("SELECT barang.*, kategori.nama_kategori
        FROM barang  JOIN kategori ON barang.kategori_id = kategori.id");
$data = $stmt-> fetchAll();

ob_start();

?>

<style>
    h2{
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;


    }

    th{
        background-color: #f2f2f2;

    }

    th,
    td{
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;

    }

    .harga{
        text-align: right;
    }
</style>

<h2>Laporan Inventaris Barang</h2>
<p>Tanggal Cetak: <?=  date('d-m-y');?></p>


<table>
    <thead>
        <tr>
            <th style="width: 10px;">No</th>
            <th style="width: 200px;">Nama Barang</th>
            <th style="width: 150px;">Kategori</th> <th style="width: 120px;">Harga</th>
            <th style="width: 80px;">Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach($data as $row):?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_barang']; ?></td>
            <td><?= $row['nama_kategori']; ?></td>
            <td class="harga">Rp <?= number_format($row['harga'], 0, ',', '.');?></td>
            <td><?= $row['stok']; ?></td> 
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php
$html = ob_get_clean();

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'en');
    $html2pdf->writeHTML($html);
    $html2pdf->output('Laporan_Barang.pdf');
} catch (Exception $e) {
    echo $e->getMessage();
}
?>