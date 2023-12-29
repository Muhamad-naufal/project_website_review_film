<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login berhasil
        session_start();
        $_SESSION['username'] = $username; // Simpan username dalam session

        // Arahkan ke halaman dashboard atau halaman lainnya
        header("Location: home.php");
        exit();
    } else {
        echo "<script>
                alert('Login gagal. Periksa kembali username dan password.');
                window.location.href = 'signin.php';
              </script>";
        exit();
    }
}

$conn->close();
