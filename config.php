<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "careon_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal. Pastikan MySQL di XAMPP sudah Start dan database careon_db sudah di-import.");
}
?>
