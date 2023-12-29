<?php
session_start();
include '../../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST["password"]);

    // Cek apakah username sudah ada dalam database
    $query = "SELECT * FROM `admin` WHERE username_admin = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username_exists'] = true;
        header("Location: tambah.php"); // Ganti halaman_ini.php dengan nama halaman saat ini
        exit();
    }

    // ... (proses untuk menambahkan username ke database)
    $result = mysqli_query($conn, "INSERT INTO `admin` (`username_admin`,`password`) VALUES ('$username', '$password');");


    header("Location:admin.php");
}
