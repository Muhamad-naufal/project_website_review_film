<?php
// Di dalam edit_profile.php
session_start();

include '../config/koneksi.php';

// Ambil data pengguna dari database
$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$_SESSION[username]'");
$row = mysqli_fetch_array($query);

// Tangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil informasi yang diedit dari formulir
    $newNama = $_POST['nama'];
    $newUsername = $_POST['username'];
    $newAlamat = $_POST['alamat'];
    $newPhoneNumber = $_POST['phone_number'];

    // Update informasi pengguna di database
    $updateQuery = mysqli_query($conn, "UPDATE user SET nama = '$newNama', username = '$newUsername', alamat = '$newAlamat', phone_number = '$newPhoneNumber' WHERE username = '$_SESSION[username]'");

    if ($updateQuery) {
        // Redirect ke halaman profil setelah perubahan disimpan
        header("Location: profil.php");
        exit();
    } else {
        // Tampilkan pesan kesalahan jika terjadi masalah saat menyimpan perubahan
        echo "Gagal menyimpan perubahan.";
    }
}
