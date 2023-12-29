<?php
include '../../config/koneksi.php';

$username = $_POST["username"];
$subject = $_POST["subject"];
$pesan = $_POST["pesan"];

$result = mysqli_query($conn, "INSERT INTO `saran` (`id_saran`,`username`,`subject`,`pesan`) VALUES ('','$username','$subject','$pesan');");


header("Location:../../Cineverse/About.php");
