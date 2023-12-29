<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $phone_number = $_POST["phone_number"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // Cek apakah username sudah digunakan
    $checkUsernameQuery = "SELECT * FROM `user` WHERE username = '$username'";
    $checkUsernameResult = $conn->query($checkUsernameQuery);

    if ($checkUsernameResult->num_rows > 0) {
        echo "<script>
                alert('Username sudah digunakan. Silakan pilih username lain.');
                window.location.href = 'signup.php'; // Ganti dengan halaman signup Anda
              </script>";
        exit();
    }

    // Jika username belum digunakan, tambahkan ke database
    $signupQuery = "INSERT INTO `user` (nama, alamat, phone_number, username, password) VALUES ('$nama', '$alamat', '$phone_number', '$username', '$password')";

    if ($conn->query($signupQuery) === TRUE) {
        // Signup berhasil
        session_start();
        $_SESSION['username'] = $username; // Simpan username dalam session

        // Arahkan ke halaman dashboard atau halaman lainnya
        header("Location: signin.php");
        exit();
    } else {
        echo "Error: " . $signupQuery . "<br>" . $conn->error;
    }
}

$conn->close();
