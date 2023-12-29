<?php
include '../config/koneksi.php';

if (isset($_POST['filmId']) && isset($_POST['userId'])) {
    $filmId = $_POST['filmId'];
    $userId = $_POST['userId'];

    // Check if the user has already liked the article
    $query = "SELECT * FROM `like` WHERE id_film_like = $filmId AND id_user_like = $userId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Unlike the article
        $deleteQuery = "DELETE FROM `like` WHERE id_film_like = $filmId AND id_user_like = $userId";
        mysqli_query($conn, $deleteQuery);
        echo 'unliked';
    } else {
        // Like the article
        $insertQuery = "INSERT INTO `like` (id_film_like, id_user_like) VALUES ($filmId, $userId)";
        mysqli_query($conn, $insertQuery);
        echo 'liked';
    }
}
