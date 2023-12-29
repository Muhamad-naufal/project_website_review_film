<?php
include '../../config/koneksi.php';

if (isset($_GET['id_nama_user'])) {
    $id_nama_user = $_GET['id_nama_user'];

    $result = mysqli_query($conn, "DELETE FROM `user` WHERE `id_nama_user` = '$id_nama_user'");

    if ($result) {
        header("Location: user.php"); // Redirect after successful deletion
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "ID not specified";
}
