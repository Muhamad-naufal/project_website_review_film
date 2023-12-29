<?php
session_start();
include '../config/koneksi.php';

$usern = $_SESSION['username'];
$result_user = mysqli_query($conn, "SELECT id_nama_user FROM `user` WHERE username = '$usern'");
$row_user = mysqli_fetch_assoc($result_user);
$id_user = $row_user['id_nama_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Check if the record exists in the database
    $query = mysqli_query($conn, "SELECT * FROM `like` WHERE id_user_like = '$id_user' AND id_film_like = '$id'");
    $row = mysqli_fetch_assoc($query);

    if (!$row) {
        // If the record does not exist, insert a new record
        mysqli_query($conn, "INSERT INTO `like` (id_film_like, id_user_like) VALUES ('$id', '$id_user')");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
        echo 'Database updated successfully.';
    } else {
        // If the record exists, delete the existing record
        mysqli_query($conn, "DELETE FROM `like` WHERE id_user_like = '$id_user' AND id_film_like = '$id'");
        echo 'Database deleted successfully.';
    }
} else {
    echo 'Invalid request.';
}
