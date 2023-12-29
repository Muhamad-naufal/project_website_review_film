<?php
// Mulai session
session_start();
?>

<?php
// Include file utils.php untuk fungsi-fungsi yang dibutuhkan (isUserLoggedIn(), redirectToLoginPage(), dsb)
include 'utils.php';
// Jika user belum login
if (!isUserLoggedIn()) {
  // Redirect ke halaman login
  redirectToLoginPage();
}

function fetchData($url)
{
  $response = file_get_contents($url);
  return json_decode($response, true);
}

$genreData = fetchData("https://api.themoviedb.org/3/genre/movie/list?api_key=efe2dac52f0aac2fa06461be76a603ad");
$genres = [];
foreach ($genreData['genres'] as $genre) {
  $genres[$genre['id']] = $genre['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Cineverse</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="home.php">Cineverse</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link active" href="home.php">Home</a></li>
          <li>
            <a class="nav-link scrollto" href="film.php">Film</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="About.php">About</a>
          </li>
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
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
          </div>
        </div>
      </div>
    </section>

    <!-- ======= On Trending Section ======= -->
    <?php
    include_once 'api/on_tending.php';
    $data = json_decode($keren->getBody());
    $results = $data->results;
    $results = array_slice($data->results, 0, 12);
    ?>
    <div class="upcoming mt-5">
      <div class="movies_box trending" style="margin-left: 20px;">
        <h1>On Trending</h1>
        <div class="box trending" style="display: flex; flex-wrap: wrap;">
          <?php
          foreach ($results as $result) { ?>
            <div class="card" style="max-width: calc(20% - 20px); margin: 10px;">
              <a href="detail_film.php?id=<?php echo $result->id ?>">
                <div class="details">
                  <!-- <a href="detail_film.php?id="> -->
                  <div class="left">
                    <p class="name"><?php echo $result->original_title ?></p>
                    <div class="date_quality">
                      <p class="date">
                        <?php
                        // Misalnya, $tanggal berisi tanggal dalam format 'Y-m-d' seperti '2023-12-23'
                        $year = date('Y', strtotime($result->release_date));
                        echo $year;
                        ?>
                    </div>
                    <p class="category">
                      <?php
                      $genreNames = [];
                      foreach ($result->genre_ids as $genreId) {
                        if (isset($genres[$genreId])) {
                          $genreNames[] = $genres[$genreId];
                        }
                      }
                      echo implode(', ', $genreNames);
                      ?>
                    </p>
                  </div>
                </div>
                <img src="https://image.tmdb.org/t/p/w500<?= $result->poster_path ?>" class="card-img-top" alt="...">
              </a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <a href="film.php">
        <button type="button" class="btn btn-outline-primary" style="border-radius: 10px; margin-left: 795px; margin-top: 10px;">View More</button>
      </a>
    </div>


    <!-- ======= Now Playing Section ======= -->
    <?php
    include_once 'api/nowplaye.php';
    $data = json_decode($mantap->getBody());
    $results = $data->results;
    $results = array_slice($data->results, 0, 12);
    ?>
    <div class="upcoming mt-5">
      <div class="movies_box trending" style="margin-left: 20px;">
        <h1>Now Played</h1>
        <div class="box trending" style="display: flex; flex-wrap: wrap;">
          <?php
          foreach ($results as $result) { ?>
            <div class="card" style="max-width: calc(20% - 20px); margin: 10px;">
              <a href="detail_film.php?id=<?php echo $result->id ?>">
                <div class="details">
                  <!-- <a href="detail_film.php?id="> -->
                  <div class="left">
                    <p class="name"><?php echo $result->original_title ?></p>
                    <div class="date_quality">
                      <p class="date">
                        <?php
                        // Misalnya, $tanggal berisi tanggal dalam format 'Y-m-d' seperti '2023-12-23'
                        $year = date('Y', strtotime($result->release_date));
                        echo $year;
                        ?>
                      </p>
                    </div>
                    <p class="category">
                      <?php
                      $genreNames = [];
                      foreach ($result->genre_ids as $genreId) {
                        if (isset($genres[$genreId])) {
                          $genreNames[] = $genres[$genreId];
                        }
                      }
                      echo implode(', ', $genreNames);
                      ?>
                    </p>
                  </div>
                </div>
                <img src="https://image.tmdb.org/t/p/w500<?= $result->poster_path ?>" class="card-img-top" alt="...">
              </a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <a href="film.php">
        <button type="button" class="btn btn-outline-primary" style="border-radius: 10px; margin-left: 795px; margin-top: 10px;">View More</button>
      </a>
    </div>
    <!-- End Upcoming Section -->

    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
          </div>
        </div>
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
  </footer>
  <!-- End Footer -->

  <!-- <div id="preloader"></div> -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://kit.fontawesome.com/6beb2a82fc.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>