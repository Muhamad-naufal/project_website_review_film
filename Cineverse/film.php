<?php
// Mulai session
session_start();
?>
<?php
include '../config/koneksi.php';
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film | Cineverse</title>
    <link href="assets/img/logo.png" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        #header {
            background-color: rgba(40, 58, 90, 0.9);
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            background-color: #111;
            padding-top: 20px;
            transition: 0.5s;
        }

        .sidebar a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 22px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .content {
            margin-left: 250px;
            padding: 1px 16px;
            height: 1000px;
        }

        /* Media Query for responsiveness */
        @media screen and (max-width: 600px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                left: 0;
            }

            .sidebar a {
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .content {
                margin-left: 0;
            }
        }

        /* Add your custom styles here */
        .portfolio-item {
            margin-bottom: 20px;
        }

        /* Additional styling for card hover effect */
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .portfolio-item {
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .details {
            padding: 15px;
            background-color: #fff;
            position: relative;
            z-index: 1;
        }

        .name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .date_quality {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .date {
            font-size: 14px;
            color: #666;
        }

        /* Add hover effect */
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        /* Add a subtle fade-in effect */
        [data-aos="fade-up"] {
            opacity: 0;
            transition: opacity 0.5s;
        }

        [data-aos="fade-up"].aos-animate {
            opacity: 1;
        }

        .left {
            margin-top: 100px;
        }
    </style>
    <!-- Template CSS Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.html">Cineverse</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="home.php">Home</a></li>
                    <li>
                        <a class="nav-link scrollto active" href="film.php">Film</a>
                    </li>
                    <li>
                        <a class=" nav-link scrollto" href="About.php">About</a>
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
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
        <a class="navbar-brand" href="#">Your Movie Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Create a list of genres -->
                <?php foreach ($genres as $genreId => $genreName) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-genre="<?php echo $genreId; ?>"><?php echo $genreName; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <section id="portfolio" class="portfolio mt-5">
        <div class="mt-5" data-aos="fade-up">
            <div class="upcoming mt-5">
                <div class="movies_box trending" style="margin-left: 40px;">
                    <div class="box trending" style="display: flex; flex-wrap: wrap;">
                        <?php
                        require_once('../vendor/autoload.php');

                        $client = new \GuzzleHttp\Client();
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;

                        $mantul = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?language=en-US&page=' . $page, [
                            'headers' => [
                                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlZmUyZGFjNTJmMGFhYzJmYTA2NDYxYmU3NmE2MDNhZCIsInN1YiI6IjY1ODJlNDllZmJlMzZmNGIyZDdmMDFiNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.hHCODLZTt5CVM4E9Lz7mo9N4VGz1W8NDnQcOwg6Wwaw',
                                'accept' => 'application/json',
                            ],
                        ]);
                        $data = json_decode($mantul->getBody());
                        $results = array_slice($data->results, 0, 18);
                        ?>
                        <?php
                        foreach ($results as $result) { ?>
                            <div class="portfolio-item filter">
                                <div class="card" style="max-width: 86rem;">
                                    <img src="https://image.tmdb.org/t/p/w500<?= $result->poster_path ?>" class="card-img-top" alt="...">
                                    <div class="details">
                                        <a href="detail_film.php?id=<?php echo $result->id ?>">
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
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add this section after the existing code -->
    <section id="portfolio" class="portfolio mt-5">
        <div class="mt-5" data-aos="fade-up">
            <div class="upcoming mt-5">
                <div class="movies_box trending" style="margin-left: 40px;">
                    <div class="trending" style="display: flex; flex-wrap: wrap;">
                        <?php foreach ($genres as $genreId => $genreName) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><?php echo $genreName; ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $genreMovies = fetchData("https://api.themoviedb.org/3/discover/movie?language=en-US&with_genres=" . $genreId . "&page=" . $page . "&api_key=efe2dac52f0aac2fa06461be76a603ad");
                                $genreResults = array_slice($genreMovies['results'], 0, 12);
                                foreach ($genreResults as $genreResult) {
                                ?>
                                    <div class="col-md-2" data-aos="fade-up">
                                        <div class="portfolio-item">
                                            <div class="card" style="position: relative;">
                                                <img src="https://image.tmdb.org/t/p/w500<?= $genreResult['poster_path']; ?>" class="card-img" alt="Card Image">
                                                <div class="card-img-overlay" style="background:#111; opacity: 0.5; margin-top: 250px; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                                                    <a href="detail_film.php?id=<?= $genreResult['id']; ?>">
                                                        <h5 class="card-title" style="font-size: 20px; font-weight: bold; color: white;"><?php echo $genreResult['original_title']; ?></h5>
                                                        <p class="card-text" style="color: white;">
                                                            <?php
                                                            $year = date('Y', strtotime($genreResult['release_date']));
                                                            echo $year;
                                                            ?>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="pagination mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    // Display "Previous" link
                    if ($page > 1) { ?>
                        <a href="?page=<?php echo ($page - 1) ?>">
                            <button type="button" class="btn btn-outline-primary" style="border-radius: 10px; margin-left:550px">Previous</button>
                        </a>
                    <?php
                    } ?>
                </div>
                <div class="col-md-6">
                    <?php
                    if ($page < $data->total_pages) { ?>
                        <a href="?page=<?php echo ($page + 1) ?>">
                            <button type="button" class="btn btn-outline-primary" style="border-radius: 10px; width:85px;">Next</button>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

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
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                Designed by <a href="https://bootstrapmade.com/">Cineverse</a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="https://kit.fontawesome.com/6beb2a82fc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Template JS Slick -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script>
        $(document).ready(function() {
            $('.genre-link').on('click', function(e) {
                e.preventDefault();

                var filter = $(this).data('filter');

                // Remove active class from all genre links
                $('.genre-link').removeClass('active');
                // Add active class to the clicked genre link
                $(this).addClass('active');

                $('.portfolio-item').fadeOut(100, function() {
                    $(this).hide().filter(filter).fadeIn(300);
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var $grid = $('.movies_box .box').isotope({
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows'
            });

            // Filter items on button click
            $('#portfolio-flters').on('click', 'li', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });

                // Ubah kelas aktif pada filter
                $('#portfolio-flters li').removeClass('filter-active');
                $(this).addClass('filter-active');
            });
        });
    </script>

    <script>
        $('.slick-two').slick({
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Tambahkan Isotope.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add pagination functionality with JS
        // You can use AJAX to load more movies without refreshing the page
        // Example: https://www.sitepoint.com/use-jquerys-ajax-function/
    </script>
    <script>
        AOS.init();
    </script>
    <!-- Add Bootstrap and jQuery JS links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script to filter movies by genre -->
    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
                var selectedGenre = $(this).data('genre');
                // Redirect or reload the page with the selected genre
                window.location.href = 'film.php?genre=' + selectedGenre;
            });
        });
    </script>
</body>

</html>