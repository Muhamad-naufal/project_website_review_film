<?php
session_start();
include '../config/koneksi.php';
$id = $_GET['id'];
$query1 = mysqli_query($conn, "SELECT AVG(komentar.rating) as average_rating FROM komentar 
    JOIN user ON komentar.id_user = user.id_nama_user 
    WHERE id_film = '$id'");
$film = mysqli_fetch_array($query1);
?>

<?php
// Include file utils.php untuk fungsi-fungsi yang dibutuhkan (isUserLoggedIn(), redirectToLoginPage(), dsb)
include 'utils.php';
// Jika user belum login
if (!isUserLoggedIn()) {
  // Redirect ke halaman login
  redirectToLoginPage();
}
?>

<?php
$api_key = "efe2dac52f0aac2fa06461be76a603ad"; // Gantilah dengan kunci API Anda
$movie_id = $_GET['id']; // Gantilah dengan ID film yang diinginkan

// URL dasar API
$base_url = "https://api.themoviedb.org/3/movie/";

// URL lengkap untuk mendapatkan data film
$url = $base_url . $movie_id . '?api_key=' . $api_key;

// Mendapatkan respons JSON dari API
$response1 = file_get_contents($url);

// Mengubah respons JSON menjadi array asosiatif
$data1 = json_decode($response1, true);

// Mengambil poster path dari data
$id = $data1['id'];
$poster_path = $data1['poster_path'];
$nama_film = $data1['original_title'];
$tanggal = $data1['release_date'];
$genres = $data1['genres'];
$overview = $data1['overview'];
$runtime = $data1['runtime'];
$banner = $data1['backdrop_path'];
// URL lengkap untuk poster
$poster_url = "https://image.tmdb.org/t/p/w500" . $poster_path;
$banner_url = "https://image.tmdb.org/t/p/w500" . $banner;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $nama_film ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=65868a4a5d554e00126ed719&product=inline-share-buttons&source=platform" async="async"></script>
  <style>
    .love-button {
      cursor: pointer;
      font-size: 1.5em;
    }

    .love-button.full {
      color: #e74c3c;
      /* Warna ikon love penuh */
    }

    .love-button.empty {
      color: lightgray;
      /* Warna ikon love kosong */
    }

    .lope {
      margin-top: -1px;
    }

    .angka_lope {
      margin-top: -5px;
      margin-left: 8px;
      font-size: 12px;
      color: white;
    }

    .share {
      margin-top: 225px;
      margin-left: 20px;
    }

    .lop {
      margin-top: 220px;
      margin-left: 390px;
    }

    .love-icon {
      display: inline-block;
      cursor: pointer;
      color: white;
      /* Default color */
      transition: color 0.3s ease;
    }

    .love-icon.loved {
      color: red;
      /* Color when loved */
    }
  </style>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v18.0&appId=<?php echo $facebookAppId ?>" nonce="5StlNltj"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iNl4nXzOtnF5Iv6Ztiq0FfEXCEuaLZh/6QCCjF5fGgAgFsnjCJYYq13dy" crossorigin="anonymous">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index.html">Cineverse</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="home.php">Home</a></li>
          <li>
            <a class="nav-link scrollto" href="film.php">Film</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="About.php">About</a>
          </li>
          <li>
          <li class="nav-item dropdown">
            <?php
            if (isset($_SESSION['username'])) {
            ?>
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['username'] ?>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profil.php">My Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="signout.php">Log Out</a></li>
              </ul>
            <?php
            } else {
            ?>
              <a class="nav-link scrollto" href="signin.php">Login</a>
            <?php
            }
            ?>

          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  <!-- End Header -->


  <main id="main">
    <!-- ======= Hero Section ======= -->
    <section id="detail-film" class="align-items-center">
      <img class="banner-single" src="<?php echo $banner_url ?>">
      <div class="container position-absolute top-0 start-50 translate-middle-x ">
        <div class="row">
          <div class="col-md-2">
            <img class="poster-single" src="<?php echo $poster_url ?>">
            <div class="d-flex">
              <div class="lop">
                <?php
                $userId = $_SESSION['username'];
                // Pastikan $_GET['id'] telah diatur sebelum menggunakannya
                if (isset($_GET['id'])) {
                  $filmId = $_GET['id'];

                  // Mengambil ID pengguna berdasarkan username
                  $result_user = mysqli_query($conn, "SELECT id_nama_user FROM user WHERE username = '$userId'");
                  $row_user = mysqli_fetch_assoc($result_user);
                  $id_user = $row_user['id_nama_user'];

                  // Set your travel article ID here
                  $query = "SELECT * FROM `like` WHERE id_film_like = $filmId AND id_user_like = $id_user";
                  $result = mysqli_query($conn, $query);

                  if (mysqli_num_rows($result) > 0) {
                    $iconClass = '<div class="love-button full"><i class="fas fa-heart"></i></div>';
                  } else {
                    $iconClass = '<div class="love-button empty"><i class="fas fa-heart kosong"></i></div>';
                  }

                  echo '<div class="like-button" data-film-id="' . $filmId . '" data-user-id="' . $id_user . '">';
                  echo $iconClass;
                  echo '</div>';

                ?>
                  <div class="angka_lope">
                    <?php
                    $filmsuka = mysqli_query($conn, "SELECT COUNT(id_user_like) AS total_likes FROM `like` WHERE id_film_like = $filmId");
                    $filmLikes = mysqli_fetch_assoc($filmsuka);
                    ?>
                    <p><?php echo $filmLikes['total_likes'] ?></p>
                  <?php
                } else {
                  echo '<p>Invalid film ID.</p>';
                }
                  ?>
                  </div>
              </div>
              <div class="sharethis-inline-share-buttons share"></div>
            </div>
          </div>
          <div class="col-md-10 position-relative">
            <div class="d-flex" style="margin-right: 300px">
              <?php
              include_once 'api/detail_film.php';
              $data = json_decode($response->getBody());

              // Check if 'results' property exists
              if (isset($data->results)) {
                $hasil = $data->results;
              } else {
                $hasil = [];
              }
              ?>
              <h1><?php echo $nama_film ?>&nbsp;
                <?php
                // Misalnya, $tanggal berisi tanggal dalam format 'Y-m-d' seperti '2023-12-23'
                $year = date('Y', strtotime($tanggal));
                echo $year;
                ?>
              </h1>
            </div>
            <div class=" d-flex">
              <p>
                <?php
                foreach ($genres as $genre) {
                  echo $genre['name'] . ", ";
                }
                ?>
              </p>
              <p class="ml-3">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-clock"></i>&nbsp;<?php echo $runtime ?> menit</p>
            </div>
            <?php
            $rating = $film['average_rating']; // Simpan nilai rating ke dalam variabel
            for ($i = 0; $i < 5; $i++) {
              if ($rating - $i >= 1) {
                // Jika nilai rating lebih besar dari i + 1, tampilkan bintang penuh
                echo '<i class="fa-solid fa-star" style="color: yellow;"></i>';
              } elseif ($rating - $i >= 0.5) {
                // Jika nilai rating lebih besar dari i + 0.5, tampilkan bintang setengah
                echo '<i class="fa-solid fa-star-half" style="color: yellow;"></i>';
              } else {
                // Selain itu, tampilkan bintang kosong
                echo '<i class="fa-regular fa-star" style="color: yellow;"></i>';
              }
            }
            ?>
            <div class="row mb-5">
              <div id="video-container"></div>
            </div>
            <div class="kotak">
              <p><?php echo $overview ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ======= End Hero Section ======= -->

    <!-- Pemain -->
    <?php
    include_once 'api/credits.php';
    $data4 = json_decode($mantul->getBody());
    ?>
    <h1 class="pemain-judul ms-5">Movie Cast</h1>
    <div class="pemain">
      <div class="row justify-content-center">
        <?php
        // Check if the "cast" property exists and is an array
        if (isset($data4->cast) && is_array($data4->cast)) {
          // Limit the loop to the first 8 items
          $maxItems = min(count($data4->cast), 8);
          for ($i = 0; $i < $maxItems; $i++) {
            $castMember = $data4->cast[$i];

            // Check if profile_path is not empty
            if (!empty($castMember->profile_path)) {
        ?>
              <div class="col text-center mb-4">
                <img src="https://image.tmdb.org/t/p/w500<?= $castMember->profile_path ?>" class="rounded-image pemain-gambar">
                <p class="pemain-nama mt-2"><?= $castMember->original_name ?></p>
                <!-- If $row['peran'] is supposed to come from somewhere else, adjust it accordingly -->
                <p class="pemain-peran">(<?php echo $castMember->character ?>)</p>
              </div>
        <?php
            }
          }
        } else {
          echo 'No cast information available.';
        }
        ?>
      </div>
    </div>
    <!-- End Pemain -->

    <!-- Recommended Movie -->
    <?php
    $api_key = "efe2dac52f0aac2fa06461be76a603ad";
    $base_url = "https://api.themoviedb.org/3";
    $popular_url = "$base_url/movie/popular?api_key=$api_key";
    $response = file_get_contents($popular_url);
    $popular_movies = json_decode($response, true)['results'];
    shuffle($popular_movies);
    $num_recommendations = 6;
    $recommended_movies = array_slice($popular_movies, 0, $num_recommendations);
    ?>
    <div class="upcoming mt-5">
      <div class="movies_box trending" style="margin-left: 20px;">
        <h1>Recomendation</h1>
        <div class="box trending" style="display: flex; flex-wrap: wrap;">
          <?php
          foreach ($recommended_movies as $movie) { ?>
            <div class="card" style="max-width: calc(20% - 20px); margin: 10px;">
              <a href="detail_film.php?id=<?php echo $movie['id'] ?>">
                <div class="details">
                  <!-- <a href="detail_film.php?id="> -->
                  <div class="left">
                    <p class="name"><?php echo $movie['original_title'] ?></p>
                    <div class="date_quality">
                      <p class="date">
                        <?php
                        // Misalnya, $tanggal berisi tanggal dalam format 'Y-m-d' seperti '2023-12-23'
                        $year = date('Y', strtotime($movie['release_date']));
                        echo $year;
                        ?>
                    </div>
                    <p class="category">
                      <?php
                      foreach ($genres as $genre) {
                        echo $genre['name'] . ", ";
                      }
                      ?>
                    </p>
                  </div>
                </div>
                <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" class="card-img-top" alt="...">
              </a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>

    <!-- End Recommendation Section -->

    <!-- Komentar -->
    <?php
    $id = $_GET['id'];
    $kueri = mysqli_query($conn, "SELECT * FROM komentar 
    JOIN user ON komentar.id_user = user.id_nama_user 
    WHERE id_film = '$id'");
    ?>
    <section id="komentar-yuk" class="mt-5">
      <div class="comments-section">
        <?php
        // Check if data is fetched successfully
        if (mysqli_num_rows($kueri) > 0) {
          while ($darat = mysqli_fetch_array($kueri)) {
            // Tampilkan komentar
        ?>
            <div class="full-comment">
              <div class="comment d-flex">
                <h6 class="nama_komen">
                  <?php echo $darat['username']; ?>
                </h6>&nbsp;&nbsp;
                <p class="tanggal"><?php echo $darat['created_at'] ?></p>
              </div>
              <div class="review">
                <p><?php echo $darat['review'] ?></p>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
      <div class="komen">
        <form action="f_komen.php" method="post">
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <label for="exampleFormControlTextarea1" class="form-label">Komentar &nbsp;</label>
                <div class="btn-group dropup-center dropup" role="group">
                  <button type="button" name="rating" class="btn btn-success dropdown-toggle" id="selectedRating" data-bs-toggle="dropdown" aria-expanded="false">
                    Rating
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" value="1" onclick="displaySelectedValue(this)">1</a></li>
                    <li><a class="dropdown-item" value="2" onclick="displaySelectedValue(this)">2</a></li>
                    <li><a class="dropdown-item" value="3" onclick="displaySelectedValue(this)">3</a></li>
                    <li><a class="dropdown-item" value="4" onclick="displaySelectedValue(this)">4</a></li>
                    <li><a class="dropdown-item" value="5" onclick="displaySelectedValue(this)">5</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <textarea class="form-control" id="komen" name="komen" rows="3"></textarea>
          </div>
          <input type="submit" class="btn btn-success kirim" value="Kirim">
        </form>
      </div>
    </section>
  </main>
  <!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-md-5 footer-contact">
            <img width="200px" src="assets/img/logo.png" alt="">
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Colaborations</h4>
            <ul>
              <li>
                <i class="bx bx-chevron-right"></i>Cinema XXI
              </li>
              <li>
                <i class="bx bx-chevron-right"></i>Cgv
              </li>
              <li>
                <i class="bx bx-chevron-right"></i>Cinepolis
              </li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-7 footer-links">
            <ul>
              <br>
              <li>
                <i class="bx bx-chevron-right"></i>Kota Cinema Mall
              </li>
              <li>
                <i class="bx bx-chevron-right"></i>Movimax
              </li>
              <li>
                <i class="bx bx-chevron-right"></i>Platinum Cineplex
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Cineverse</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <strong><span>Cineverse</span></strong>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://kit.fontawesome.com/6beb2a82fc.js" crossorigin="anonymous"></script>
  <script>
    let selectedRating = null; // Inisialisasi variabel untuk menyimpan nilai rating

    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.addEventListener('click', function() {
        selectedRating = this.getAttribute('value');
        console.log("Nilai rating yang dipilih:", selectedRating);
      });
    });

    // Event listener untuk form saat dikirimkan
    document.querySelector('.komen form').addEventListener('submit', function(event) {
      event.preventDefault(); // Menghentikan pengiriman form secara default

      let review = document.getElementById('komen').value; // Ambil nilai komentar dari form
      let idFilm = <?php echo $_GET['id']; ?>; // Ambil ID Film dari URL

      // Kirim nilai 'rating' dan 'komentar' ke server untuk disimpan ke dalam database
      fetch('f_komen.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `id=${idFilm}&komen=${review}&rating=${selectedRating}`,
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok. Status: ' + response.status);
          }
          return response.text();
        })
        .then(data => {
          console.log('Data berhasil dikirim ke server:', data);
          window.location.href = `detail_film.php?id=${idFilm}`;
        })
        .catch(error => {
          console.error('There has been a problem with your fetch operation:', error);
        });

    });
  </script>

  <script>
    function displaySelectedValue(element) {
      var selectedValue = element.getAttribute('value');
      document.getElementById('selectedRating').innerHTML = 'Rating: ' + selectedValue;
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.like-button').click(function() {
        var filmId = $(this).data('film-id');
        var userId = $(this).data('user-id');
        var likeButton = $(this); // Store the like button element

        $.ajax({
          type: 'POST',
          url: 'f_suka.php',
          data: {
            filmId: filmId,
            userId: userId
          },
          success: function(response) {
            // Handle the response if needed

            // Reload the page
            location.reload();
          },
          error: function(error) {
            // Handle the error if needed
            console.error('Error:', error);
          }
        });
      });
    });
  </script>
  <script>
    // Ganti URL JSON dan API Key sesuai dengan kebutuhan Anda
    var jsonUrl = 'https://api.themoviedb.org/3/movie/<?php echo $id ?>/videos?api_key=<?php echo $api_key ?>';

    // Fungsi untuk mengambil data JSON dari URL
    function fetchJSON(url, callback) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          callback(data);
        }
      };
      xhr.open('GET', url, true);
      xhr.send();
    }

    // Fungsi untuk menampilkan video YouTube dalam elemen iframe
    function displayYouTubeVideo(videoKey) {
      var videoContainer = document.getElementById('video-container');
      videoContainer.innerHTML = '<iframe class="mt-1 mb-1" width="220" height="115" src="https://www.youtube.com/embed/' + videoKey + '" frameborder="0" allowfullscreen></iframe>';
    }

    // Panggil fungsi fetchJSON dengan URL yang sesuai
    fetchJSON(jsonUrl, function(data) {
      if (data.results && data.results.length > 0) {
        // Ambil kunci video dari data JSON (asumsi video pertama dalam array)
        var videoKey = data.results[0].key;

        // Tampilkan video YouTube
        displayYouTubeVideo(videoKey);
      } else {
        // Tampilkan pesan jika tidak ada video yang ditemukan
        document.getElementById('video-container').innerHTML = 'Video not found';
      }
    });
  </script>
</body>

</html>