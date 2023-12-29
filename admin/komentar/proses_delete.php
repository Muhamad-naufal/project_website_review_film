<?php
include '../../config/koneksi.php';

$result = mysqli_query($conn, "DELETE from komentar where `id_nama_review` = '$_GET[id_nama_review]'");


header("Location:komentar.php");
