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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Dalam tag head di HTML Anda -->
    <style>
        /* Style untuk bagian profile */
        .profile {
            padding: 80px 0;
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            border-radius: 10px;
            max-width: 500px;
            max-height: 700px;
        }

        .profile h1 {
            font-size: 36px;
            margin-bottom: 30px;
            color: #333;
        }

        .profile .row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
        }

        .profile-info {
            text-align: left;
        }

        .profile-info .info-item {
            margin-bottom: 20px;
        }

        .profile-info p {
            font-size: 18px;
            color: #555;
        }

        .edit-profile {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2980b9;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .edit-profile:hover {
            background-color: #1a5276;
        }

        /* Style untuk pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
            /* Atur lebar sesuai kebutuhan */
        }

        /* Style untuk tombol tutup */
        #closeButton {
            margin-top: 10px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .profile .row {
                flex-direction: column;
            }

            .profile .row .col-md-6 {
                width: 100%;
                margin-bottom: 30px;
            }
        }
    </style>
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
                    <li><a class="nav-link" href="home.php">Home</a></li>
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
                                <li><a class="dropdown-item active" href="profil.php">My Profile</a></li>
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
        <?php
        include '../config/koneksi.php';
        $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$_SESSION[username]'");
        $row = mysqli_fetch_array($query);
        ?>
        <section id="cta" class="cta">
            <div class="container profile justify-content-center text-center" data-aos="zoom-in">
                <h1>My Profile</h1>
                <div class="row">
                    <div class="col-md-6">
                        <img src="assets/img/profil.png" alt="Profile Picture" class="img-fluid" />
                    </div>
                    <div class="align-items-start col-md-6">
                        <div class="profile-info">
                            <div class="info-item">
                                <p><?php echo $row['nama'] ?></p>
                            </div>
                            <hr>
                            <div class="info-item">
                                <p><?php echo $row['username'] ?></p>
                            </div>
                            <hr>
                            <div class="info-item">
                                <p><?php echo $row['alamat'] ?></p>
                            </div>
                            <hr>
                            <div class="info-item">
                                <p><?php echo $row['phone_number'] ?></p>
                            </div>
                            <hr>
                            <div class="info-item">
                                <button id="editButton" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <!-- Pop-up Form -->
    <div class="popup-overlay" id="editPopup">
        <div class="popup">
            <h2>Edit Profile</h2>
            <form id="editForm" method="POST" action="update_profile.php">
                <!-- Tambahkan input fields untuk pengeditan -->
                <input type="text" name="nama" id="editNama" value="<?php echo $row['nama'] ?>">
                <input type="text" name="username" id="editUsername" value="<?php echo $row['username'] ?>">
                <input type="text" name="alamat" id="editAlamat" value="<?php echo $row['alamat'] ?>">
                <input type="text" name="phone_number" id="editPhoneNumber" value="<?php echo $row['phone_number'] ?>">
                <button type="submit" class="btn btn-success mt-2">Simpan</button>
            </form>
            <button id="closeButton" class="btn btn-secondary">Tutup</button>
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
    <script>
        // Mengambil tombol "Edit" dan pop-up
        const editButton = document.getElementById('editButton');
        const editPopup = document.getElementById('editPopup');
        const closeButton = document.getElementById('closeButton');

        // Menampilkan pop-up saat tombol "Edit" diklik
        editButton.addEventListener('click', function() {
            editPopup.style.display = 'flex';
        });

        // Menyembunyikan pop-up saat tombol "Tutup" diklik
        closeButton.addEventListener('click', function() {
            editPopup.style.display = 'none';
        });
    </script>
</body>



</html>