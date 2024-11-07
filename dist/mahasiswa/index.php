<?php
include '../config.php';

session_start();

error_reporting(0);

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

// Query untuk mengambil hasil rekomendasi mahasiswa
$sql = "SELECT * FROM hasil_rekomendasi WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$hasil = $user['hasil'];

$stmt->close();

// Query untuk mengambil data nilai skill pengguna
$sql = "SELECT * FROM nilai_skill WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$nilaiSkill = $result->fetch_assoc();

$nilaiSI = $nilaiSkill['nilaiSI'];
$nilaiJ = $nilaiSkill['nilaiJ'];
$nilaiRPL = $nilaiSkill['nilaiRPL'];

$stmt->close();

// Query untuk mengambil data nilai matakuliah pengguna
$sql = "SELECT * FROM nilai_mk WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$nilaiMK = $result->fetch_assoc();

$nilaiSIMK = $nilaiMK['nilaiSI'];
$nilaiJMK = $nilaiMK['nilaiJ'];
$nilaiRPLMK = $nilaiMK['nilaiRPL'];

$stmt->close();

// Query untuk mengambil data tingkat minat pengguna
$sql = "SELECT * FROM tingkat_minat WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$tingkatMinat = $result->fetch_assoc();

$minatSI = $tingkatMinat['minatSI'];
$minatJ = $tingkatMinat['minatJ'];
$minatRPL = $tingkatMinat['minatRPL'];

// Pengkodisian Data Tingkat Minat : Sistem Informasi
if ($minatSI == 1) {
    $minatSI = "Sangat Tidak Berminat";
} elseif ($minatSI == 2) {
    $minatSI = "Kurang Minat";
} elseif ($minatSI == 3) {
    $minatSI = "Minat";
} elseif ($minatSI == 4) {
    $minatSI = "Cukup Minat";
} elseif ($minatSI == 5) {
    $minatSI = "Sangat Minat";
}

// Pengkodisian Data Tingkat Minat : Jaringan 
if ($minatJ == 1) {
    $minatJ = "Sangat Tidak Berminat";
} elseif ($minatJ == 2) {
    $minatJ = "Kurang Minat";
} elseif ($minatJ == 3) {
    $minatJ = "Minat";
} elseif ($minatJ == 4) {
    $minatJ = "Cukup Minat";
} elseif ($minatJ == 5) {
    $minatJ = "Sangat Minat";
}

// Pengkodisian Data Tingkat Minat : Rekayasa Perangkat Lunak
if ($minatRPL == 1) {
    $minatRPL = "Sangat Tidak Berminat";
} elseif ($minatRPL == 2) {
    $minatRPL = "Kurang Minat";
} elseif ($minatRPL == 3) {
    $minatRPL = "Minat";
} elseif ($minatRPL == 4) {
    $minatRPL = "Cukup Minat";
} elseif ($minatRPL == 5) {
    $minatRPL = "Sangat Minat";
}

$stmt->close();


// Query untuk mengambil data skill
$sql_skills = "SELECT namaSkill FROM nilai_skill WHERE nim = ?";
$stmt_skills = $conn->prepare($sql_skills);
$stmt_skills->bind_param("i", $nim);
$stmt_skills->execute();
$result_skills = $stmt_skills->get_result();
$skills_row = $result_skills->fetch_assoc();
$stmt_skills->close();

$conn->close();

// Pisahkan nama skill menjadi array
$namaSkillsArray = explode(", ", $skills_row['namaSkill']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SPKBM</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<style>
    table {
        border-collapse: collapse;
        width: 80%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;

    }

    th,
    td:first-child {
        border: none;
    }

    .cetak {
        margin-top: 20px;
        margin-left: 230px;
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
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                                <a class="nav-link" href="pilihSkill.php">Input Nilai Skill</a>
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
                    <h3 class="mt-4">Profile</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </main>

            <!-- Profile Mahasiswa -->
            <div id="content" class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6" style="margin-left: 200px;">
                            <div class="profile-head">
                                <h5>
                                    <?php echo "<p>" . htmlspecialchars($nama) . "</p>"; ?>
                                </h5>
                                <h6>
                                    <?php echo "<p>" . htmlspecialchars($nim) . "</p>"; ?>
                                </h6>
                                <p class="proile-rating mb-4"><b class="btn btn-primary">Hasil Rekomendasi : <span><?php echo htmlspecialchars($hasil); ?></b></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Nilai</a>

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Nilai Skill</th>
                                                    <th>Nilai Mata Kuliah</th>
                                                    <th>Tingkat Minat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sistem Informasi</td>
                                                    <td><?php echo htmlspecialchars($nilaiSI); ?></td>
                                                    <td><?php echo htmlspecialchars($nilaiSIMK); ?></td>
                                                    <td><?php echo htmlspecialchars($minatSI); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jaringan</td>
                                                    <td><?php echo htmlspecialchars($nilaiJ); ?></td>
                                                    <td><?php echo htmlspecialchars($nilaiJMK); ?></td>
                                                    <td><?php echo htmlspecialchars($minatJ); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Rekayasa Perangkat Lunak</td>
                                                    <td><?php echo htmlspecialchars($nilaiRPL); ?></td>
                                                    <td><?php echo htmlspecialchars($nilaiRPLMK); ?></td>
                                                    <td><?php echo htmlspecialchars($minatRPL); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-info cetak" onclick="printPDF()">Cetak Hasil Rekomendasi</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-work">
                                <b>Skill</b>
                                <br>
                                <?php
                                foreach ($namaSkillsArray as $skill) {
                                    echo '<a href="#">' . htmlspecialchars($skill) . '</a><br />';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

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
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>

    <script>
        function printPDF() {
            window.print();
        }
    </script>

</body>

</html>