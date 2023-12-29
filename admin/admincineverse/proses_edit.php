<?php
include '../../config/koneksi.php';

$username = $_POST["username"];
$password = md5($_POST["password"]);

$result = mysqli_query($conn, "UPDATE `admin` set `username_admin`= '$username',`password`='$password' where `id` = '$_GET[id]'");



header("Location:admin.php");
