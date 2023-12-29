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

    <title>About | Cineverse</title>
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
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <style>
        #header {
            background-color: rgba(40, 58, 90, 0.9);
        }
    </style>

</head>

<body>
    <?php
    include '../config/koneksi.php';
    $query = mysqli_query($conn, "SELECT * FROM saran ORDER BY id_saran Asc");
    ?>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="#">Cineverse</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="home.php">Home</a></li>
                    <li>
                        <a class="nav-link scrollto" href="film.php">Film</a>
                    </li>
                    <li>
                        <a class="nav-link scrollto active" href="About.php">About</a>
                    </li>
                    <li><a class="nav-link scrollto" href="#team">Team</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
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
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about mt-5">
            <div class="container" data-aos="fade-up">

                <div class="section-title mt-5">
                    <h2>About Us</h2>
                </div>

                <div class="row-content">
                    <div class="" style="text-align: justify;">
                        <p>
                            Selamat datang di <b>Cineverse</b>, rumah bagi para pecinta film sejati! Menyatukan kegembiraan dan kecintaan kita pada dunia perfilman, situs ini membawa pengalaman serba film dalam genggaman Anda. <b>Cineverse</b> dirancang untuk menjadi pusat informasi komprehensif yang tidak hanya memenuhi dahaga pengetahuan Anda tentang film terbaru tetapi juga memberikan ruang untuk berbagi pengalaman dan mendalami keragaman industri perfilman. <b>Cineverse</b> bukan sekadar situs web, tetapi rumah bagi para penggemar film sejati yang menghargai seni dan keindahan di balik layar perak. Pilih <b>Cineverse</b> untuk sebuah perjalanan film yang mendalam, penuh warna, dan selalu terkini!"</p>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
            <div class="container-fluid" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                        <div class="content">
                            <h3>CINE<strong>VERSE</strong></h3>
                            <p> Berikut adalah alasan mengapa kamu harus memilih Cineverse :
                            </p>
                        </div>

                        <div class="accordion-list">
                            <ul>
                                <li>
                                    <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Sumber Informasi Terkini
                                        <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                        <p>
                                            Memberikan informasi terbaru seputar film, termasuk
                                            jadwal rilis, berita terkini, dan cuplikan eksklusif
                                            tentang produksi film.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Konten yang Beragam
                                        <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Menyediakan artikel menarik, wawancara dengan pembuat
                                            film, serta informasi terkait industri perfilman untuk
                                            memberikan pengalaman sinematik yang lebih kaya.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Membuat Pengalaman Menonton Lebih
                                        Bermakna <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                    <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                        <p>
                                            Melalui fitur-fitur yang menginspirasi, website film
                                            membawa pengalaman menonton film menjadi lebih bermakna
                                            dan mendalam bagi setiap pengunjungnya.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/cn.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
                </div>

            </div>
        </section><!-- End Why Us Section -->
        <!-- ======= Cta Section ======= -->
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
        <!-- End Cta Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title mt-5">
                    <h2>Team</h2>
                    <p></p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="member d-flex align-items-start">
                            <div class="pic">
                                <img src="assets/img/team/dzikri.jpg" class="img-fluid" alt="" />
                            </div>
                            <div class="member-info mt-5">
                                <h4>Muhammad Dzikri Mufarrij</h4>
                                <hr>
                                <p>Mahasiswa</p>
                                <div class="social">
                                    <a href="https://instagram.com/dzikbae?igshid=MmVlMjlkMTBhMg=="><i class="ri-instagram-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="member d-flex align-items-start">
                            <div class="pic">
                                <img src="assets/img/team/dhilah.jpg" class="img-fluid" alt="" />
                            </div>
                            <div class="member-info mt-5">
                                <h4>Siti Nur Fadhilah</h4>
                                <hr>
                                <p>Mahasiswa</p>
                                <div class="social">
                                    <a href="https://instagram.com/_dhils12?igshid=NzZlODBkYWE4Ng=="><i class="ri-instagram-fill"></i></a>
                                    <a href="https://www.linkedin.com/in/siti-nur-fadhilah-757974249/"> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="member d-flex align-items-start">
                            <div class="pic">
                                <img src="assets/img/team/arya.png" class="img-fluid" alt="" />
                            </div>
                            <div class="member-info mt-5">
                                <h4>Arya Dewantara</h4>
                                <hr>
                                <p>Mahasiswa</p>
                                <div class="social">
                                    <a href="https://x.com/arydwntr_?t=cBhHCJLqHBMEi0lI3qJ-kw&s=08"><i class="ri-twitter-fill"></i></a>
                                    <a href="https://www.instagram.com/arydwntr_/"><i class="ri-instagram-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4" data-aos="zoom-in" data-aos-delay="400">
                        <div class="member d-flex align-items-start">
                            <div class="pic">
                                <img src="assets/img/team/raisa.jpg" class="img-fluid" alt="" />
                            </div>
                            <div class="member-info mt-5">
                                <h4>Raisa Nurlita</h4>
                                <hr>
                                <p>Mahasiswa</p>
                                <div class="social">
                                    <a href="https://www.facebook.com/profile.php?id=61553995785977&mibextid=ZbWKwL"><i class="ri-facebook-fill"></i></a>
                                    <a href="https://instagram.com/raisanurlita?igshid=NzZlODBkYWE4Ng=="><i class="ri-instagram-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Team Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title mt-5">
                    <h2>Frequently Asked Questions</h2>
                    <p></p>
                </div>

                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Apa itu Cineverse ?
                                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                                <p>
                                    Cineverse adalah platform daring yang didedikasikan untuk
                                    menyediakan informasi, ulasan, berita terkini, trailer, dan
                                    konten terkait film kepada pengguna. Situs web ini dapat
                                    menyajikan berbagai macam topik terkait dunia perfilman,
                                    seperti ulasan film, sinopsis, peringkat, jadwal rilis,
                                    wawancara dengan aktor dan sutradara, artikel tentang
                                    industri film, serta panduan untuk menonton film secara
                                    online atau di bioskop. Biasanya, website film menyediakan
                                    database yang luas mengenai berbagai judul film dari
                                    berbagai genre, tahun rilis, dan negara asalnya. Beberapa
                                    juga menawarkan layanan berlangganan atau penjualan film
                                    digital.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Dimana saya bisa menonton ?
                                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Tonton di mana pun, kapan pun. Masuk ke akun cineverse-mu
                                    untuk menonton langsung di website Cineverse dari komputer pribadi
                                    atau di perangkat yang terhubung ke Internet dan mendukung
                                    website Cineverse
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="300">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">
                                Apa yang bisa ditonton di Cineverse?
                                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Cineverse memiliki pustaka lengkap yang berisi film layar
                                    lebar. Tonton sepuasnya, kapan pun kamu mau.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="400">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Apakah Cineverse sesuai bagi anak - anak ?
                                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Pengalaman Cineverse Anak disertakan dalam keanggotaan agar
                                    kamu punya kontrol orang tua saat anak-anak menikmati film
                                    untuk keluarga di rumah.
                                </p>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </section>
        <!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title mt-5">
                    <h2>Kritik & Saran</h2>
                </div>

                <div class="row">


                    <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-center">
                        <form action="../admin/kotaksaran/proses_tambah_saran.php" method="post" role="form" class="php-email-form" id="contact">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" required />
                            </div>
                            <div class="form-group">
                                <label for="name">Message</label>
                                <textarea class="form-control" name="pesan" rows="10" id="pesan" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">
                                    Your message has been sent. Thank you!
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Section -->
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
                Designed by Cineverse</a>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>