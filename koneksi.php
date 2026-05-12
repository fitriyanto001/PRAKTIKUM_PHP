<?php
$host = "localhost";
$db   = "db_praktikum_php";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Koneksi Berhasil!"; // Gunakan hanya untuk testing
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
//mengubah nama database di koneksi.php muncul tulisan
//di browser Fatal error: Uncaught PDOException: SQLSTATE[HY000]
// [1049] Unknown database 'db_praktikum_pp' in C:\laragon\www\PraktikumPHP\koneksi.php:20 Stack 
//trace: #0 C:\laragon\www\PraktikumPHP\index.php(2): require() #1 {main} thrown in C:\laragon\www\PraktikumPHP\koneksi.php on line 20
//htmlspecialchars() sangat penting untuk keamanan karena berfungsi mencegah serangan XSS (Cross-Site Scripting) dengan mengubah karakter berbahaya seperti <, >, dan " menjadi bentuk aman. Di Laravel, perlindungan ini sudah otomatis dilakukan oleh Blade saat menggunakan sintaks {{ $data }}, sehingga data yang ditampilkan ke browser sudah di-escape.
//Penggunaan variabel $stmt (Statement) adalah praktik standar dalam PDO, karena mewakili hasil query database. Membiasakan penggunaan $stmt membuat kode lebih konsisten, mudah dipahami, dan sesuai dengan konvensi umum dalam pengembangan PHP.