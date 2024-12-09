<?php
include '../config.php';

session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit();
}

$nim = $_SESSION['nim'];

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama = $user['nama'];

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Input Nilai Mata Kuliah - SPKBM</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<style>
    #success_message {
        display: none;
    }
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">SPK Bidang Minat</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Profile
                        </a>
                        <div class="sb-sidenav-menu-heading">Nilai</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Input Nilai
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="inputNilaiMK.php">Input Nilai Mata Kuliah</a>
                                <a class="nav-link" href="pilihSkill.php">Pilih Skill</a>
                                <a class="nav-link" href="pilihMinat.php">Pilih Minat</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="lihatRekomendasi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                            Lihat Rekomendasi
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo "<p>Selamat datang, " . htmlspecialchars($nama) . "</p>"; ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Nilai Mata Kuliah</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Input Nilai mata Kuliah</li>
                    </ol>
                </div>
                <div class="container mt-5">
                    <h5 class="mb-4">Form Input Nilai Mata Kuliah</h5>
                    <form action="handle_inputMK.php" method="POST">
    <div class="row">
        <!-- DPSI -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course1">Dasar Pengembangan Sistem Informasi</label>
                <select class="form-control" name="course1" id="course1" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
        <!-- BASIS DATA -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course2">Basis Data</label>
                <select class="form-control" name="course2" id="course2" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="8">A</option>
                    <option value="7">B+</option>
                    <option value="6">B</option>
                    <option value="5">C+</option>
                    <option value="4">C</option>
                    <option value="1">D</option>
                </select>
            </div>
        </div>
        <!-- APSI -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course3">Analisis dan Perancangan Sistem Informasi</label>
                <select class="form-control" name="course3" id="course3" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- KEAMANAN JARINGAN DAN DATA -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course4">Keamanan Jaringan dan Data</label>
                <select class="form-control" name="course4" id="course4" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
        <!-- JARKOM -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course5">Jaringan Komputer</label>
                <select class="form-control" name="course5" id="course5" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="8">A</option>
                    <option value="7">B+</option>
                    <option value="6">B</option>
                    <option value="5">C+</option>
                    <option value="4">C</option>
                    <option value="1">D</option>
                </select>
            </div>
        </div>
        <!-- PRAK JARKOM -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course6">Praktikum Jaringan Komputer</label>
                <select class="form-control" name="course6" id="course6" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- RPL -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course7">Rekayasa Perangkat Lunak</label>
                <select class="form-control" name="course7" id="course7" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
        <!-- DATA MINING -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course8">Data Mining</label>
                <select class="form-control" name="course8" id="course8" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
        <!-- KECERDASAN BUATAN -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="course9">Kecerdasan Buatan</label>
                <select class="form-control" name="course9" id="course9" required>
                    <option value="" disabled selected>Pilih nilai</option>
                    <option value="12">A</option>
                    <option value="10.5">B+</option>
                    <option value="9">B</option>
                    <option value="7.5">C+</option>
                    <option value="6">C</option>
                    <option value="3">D</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SPKBM 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <script>

    </script>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>