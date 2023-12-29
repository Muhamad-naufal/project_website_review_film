<?php
include '../../config/koneksi.php';

$result = mysqli_query($conn, "DELETE from `admin` where `id` = '$_GET[id]'");


header("Location:admin.php");
?>