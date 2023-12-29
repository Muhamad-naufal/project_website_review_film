<?php
session_start();
include "../config/koneksi.php";

// Pastikan untuk selalu melakukan sanitasi data sebelum penggunaannya
$review = mysqli_real_escape_string($conn, $_POST['komen']);
$id = $_POST['id'];
$user = $_SESSION['username'];
$rating = $_POST['rating'];

// Dapatkan ID pengguna dari tabel 'user'
$result_user = mysqli_query($conn, "SELECT id_nama_user FROM `user` WHERE username = '$user'");
$row_user = mysqli_fetch_assoc($result_user);
$id_user = $row_user['id_nama_user'];

// Gunakan prepared statement untuk memasukkan data ke dalam tabel 'komentar'
$stmt = $conn->prepare("INSERT INTO komentar (id_film, id_user, review, rating) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $id, $id_user, $review, $rating);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Redirect ke halaman detail film dengan parameter id
    // header("location: detail_film.php?id=$id");
} else {
    // Handle jika terjadi kesalahan saat memasukkan data ke dalam database
    echo "Gagal menyimpan komentar. Silakan coba lagi.";
}

$stmt->close();
$conn->close();
