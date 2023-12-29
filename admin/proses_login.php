<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM `admin` WHERE username_admin = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login berhasil
        session_start();
        $_SESSION['username_admin'] = $username; // Simpan username dalam session

        // Arahkan ke halaman dashboard atau halaman lainnya
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>
                alert('Login gagal. Periksa kembali username dan password.');
                window.location.href = 'index.php';
              </script>";
        exit();
    }
}

$conn->close();
