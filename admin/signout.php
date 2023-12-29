<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Arahkan pengguna ke halaman awal atau halaman lainnya
header("Location: index.php"); // Ganti dengan halaman yang diinginkan
exit();
