<?php
session_start();
?>

<?php
// Include file utils.php untuk fungsi-fungsi yang dibutuhkan (isUserLoggedIn(), redirectToLoginPage(), dsb)
include '../utils.php';
// Jika user belum login
if (!isAdminLoggedIn()) {
    // Redirect ke halaman login
    redirectToLoginAdminPage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cineverse | Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Page Content -->
    <div class="container-fluid mt-5 ">
        <?php
        include "../../config/koneksi.php";
        $query = mysqli_query($conn, "SELECT * FROM admin ORDER BY id ASC");
        ?>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <img src="../assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">Cineverse</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div><!-- End Logo -->

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["username_admin"] ?></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6><?php echo $_SESSION["username_admin"] ?></h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="../signout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="../dashboard.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="dashboard.php">
                        <i class="bi bi-menu-button-wide"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="../user/user.php">
                                <i class="bi bi-circle"></i><span>User Cineverse</span>
                            </a>
                        </li>
                        <li>
                            <a href="../komentar/komentar.php">
                                <i class="bi bi-circle"></i><span>Review</span>
                            </a>
                        </li>
                        <li>
                            <a href="../kotaksaran/pesan.php">
                                <i class="bi bi-circle"></i><span>Pesan</span>
                            </a>
                        </li>
                        <li>
                            <a href="../like/like.php">
                                <i class="bi bi-circle"></i><span>Film Paling Banyak Disukai</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Forms Nav -->
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">
                        <i class="bi bi-grid"></i>
                        <span>Admin Cineverse</span>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- End Sidebar-->

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Data Admin</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admin Cineverse</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->


            <!-- Table -->
            <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered" id="data-tabel" class="display" style="width:100%">
                    <a href="tambah.php?" class="btn btn-light" style="margin-bottom:5px"><i class="fa-solid fa-user-plus"></i></a>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody> <?php
                            if (mysqli_num_rows($query) > 0) {
                                $no = 1;
                                while ($data = mysqli_fetch_array($query)) {
                            ?> <tr>
                                    <td> <?php echo $no ?></td>
                                    <td> <?php echo $data["username_admin"] ?></td>
                                    <td> <a class="btn btn-warning" href="edit.php?id=<?php echo $data["id"] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="btn btn-danger" href="proses_hapus.php?id=<?php echo $data["id"] ?>" onclick="return confirm('Yakin Data Akan Dihapus?')">
                                            <i class="fa-solid fa-trash-can"></i> </a>
                                    </td>
                                </tr>
                            <?php $no++;
                                } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Cineverse Admin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <strong><span>Cineverse</span></strong>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script src="https://kit.fontawesome.com/6beb2a82fc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#data-tabel');
    </script>
    <script>
        $(document).ready(function() {
            // Menangani klik tombol "Hapus"
            $('.btn-delete').on('click', function(e) {
                e.preventDefault(); // Mencegah tindakan asli tautan

                var id = $(this).data('id');
                var confirmation = confirm("Apakah Anda yakin ingin menghapus produk ini?");

                if (confirmation) {
                    // Jika pengguna mengonfirmasi, arahkan ke halaman proses penghapusan
                    window.location.href = "proses_hapus.php?id=" + id;
                } else {
                    // Jika pengguna membatalkan, tidak terjadi apa-apa
                }
            });
        });
    </script>

</body>

</html>