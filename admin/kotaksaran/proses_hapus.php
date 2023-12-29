<?php
include '../../config/koneksi.php';

$result = mysqli_query($conn, "DELETE from saran where `id_saran` = '$_GET[id_saran]'");


header("Location:pesan.php");
