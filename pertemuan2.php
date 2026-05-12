<?php
// Data mahasiswa dalam bentuk Array Multidimensi (Array di dalam array)
$siswa = [
    ["nama" => "Andy", "nilai" => 85, "grade" => "A"],
    ["nama" => "Budi", "nilai" => 60, "grade" => "D"],
    ["nama" => "Cindy", "nilai" => 95, "grade" => "A"],
    ["nama" => "Dewi", "nilai" => 40, "grade" => "E"],
];

echo "<h2>Daftar Kelulusan Mahasiswa</h2>";
echo "<table border='1' cellpadding='10' cellspacing='0' >";
echo "<tr><th>Nama</th><th>Nilai</th><th>Grade</th><th>Keterangan</th></tr>";

foreach ($siswa as $s) {
    if ($s["nilai"] >= 80) {
        $grade = "A";
        $keterangan = "LULUS";
        $warna = "green";   
    } elseif ($s["nilai"] >= 75) {
        $grade = "B+";
        $keterangan = "LULUS";
        $warna = "green";
    } elseif ($s["nilai"] >= 65) {
        $grade = "C+";
        $keterangan = "LULUS";
        $warna = "orange";
    } elseif ($s["nilai"] >= 60) {
        $grade = "C";
        $keterangan = "PERLU MENGULANG";
        $warna = "orange";
    }
    else {
        $keterangan = "TIDAK LULUS";
        $warna = "red";
    }

    echo "<tr>";
    echo "<td>". $s['nama']. "</td>";
    echo "<td>". $s['nilai']. "</td>";
    echo "<td>". $s['grade']. '</td>';
    echo "<td style='color: $warna;'>". $keterangan. "</td>";
}

echo "</table>";