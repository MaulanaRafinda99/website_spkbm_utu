<?php
include '../config.php';

session_start();

error_reporting(0);


// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama = $user['username'];

// Mendapatkan data pengguna sesuai nim
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM users WHERE nim = $nim";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Mahasiswa Tidak Ditemukan";
    }
} else {
    echo "NIM Mahasiswa Tidak Tersedia";
}


// Mendapatkan data nilai mata kuliah mahasiswa sesuai nim
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM nilai_mk WHERE nim = $nim";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $nilai_mk = $result->fetch_assoc();
    } else {
        echo "Nilai MK Tidak Tersedia";
    }
} else {
    echo "NIM Mahasiswa Tidak Tersedia";
}

// Mendapatkan data nilai skill mahasiswa sesuai nim
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM nilai_skill WHERE nim = $nim";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $nilai_skill = $result->fetch_assoc();
    } else {
        echo "Nilai Skill Tidak Tersedia";
    }
} else {
    echo "NIM Mahasiswa Tidak Tersedia";
}

// Mendapatkan nilai tingkat minat mahasiswa sesuai nim
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM tingkat_minat WHERE nim = $nim";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $nilai_minat = $result->fetch_assoc();
    } else {
        echo "Nilai Data Minat Tidak Tersedia";
    }
} else {
    echo "NIM Mahasiswa Tidak Tersedia";
}

// Mendapatkan data hasil rekomendasi mahasiswa sesuai nim
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM hasil_rekomendasi WHERE nim = $nim";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $hasil_Rekomendasi = $result->fetch_assoc();
    } else {
        echo "Rekomendasi Belum Tersedia";
    }
} else {
    "NIM Mahasiswa Tidak Tersedia";
}
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
    <!------ Include the above in your HEAD tag ---------->
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

    .container {
        padding: 2rem 0rem;
    }

    h4 {
        margin: 2rem 0rem 1rem;
    }

    .table-image {

        td,
        th {
            vertical-align: middle;
        }
    }
</style>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">SPK Bidang Minat</a>
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
                            Data Mahasiswa
                        </a>
                        <a class="nav-link" href="alternatif.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cube"></i></div>
                            Data Alternatif
                        </a>
                        <div class="sb-sidenav-menu-heading">Nilai</div>
                        <a class="nav-link" href="data_hasilRekomendasi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                            Data Hasil Rekomendasi
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
                    <h3 class="mt-4">Data Mahasiswa</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Detail Mahasiswa</li>
                    </ol>
                </div>
            </main>

            <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        
                        <div class="col-md-6 ml-4">
                            <div class="profile-head">
                                <?php if (!empty($user)) : ?>
                                    <h5>
                                        <?php echo "<p>" . ($user['nama']) . "</p>"; ?>
                                    </h5>
                                    <h6>
                                        <?php echo "<p>" . ($user['nim']) . "</p>"; ?>
                                    </h6>
                                <?php endif; ?>
                                <?php if (!empty($hasil_Rekomendasi)) : ?>
                                    <p class="proile-rating mb-4"><b class="btn btn-primary">Hasil Rekomendasi : <span><?php echo ($hasil_Rekomendasi['hasil']); ?></b></p>
                                <?php endif; ?>
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
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_skill['nilaiSI']); ?></td>
                                                    <?php endif; ?>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_mk['nilaiSI']); ?></td>
                                                    <?php endif; ?>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_minat['minatSI']); ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                                <tr>
                                                    <td>Jaringan</td>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_skill['nilaiSI']); ?></td>
                                                    <?php endif; ?>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_mk['nilaiJ']); ?></td>
                                                    <?php endif; ?>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_minat['minatJ']); ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                                <tr>
                                                    <td>Rekayasa Perangkat Lunak</td>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_skill['nilaiSI']); ?></td>
                                                    <?php endif; ?>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_mk['nilaiRPL']); ?></td>
                                                    <?php endif; ?>
                                                    <?php if (!empty($nilai_mk)) : ?>
                                                        <td><?php echo ($nilai_minat['minatRPL']); ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href='index.php' class='btn btn-success'>Kembali <i class='fa fa-angle-double-left'></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
    <script src=".//js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src=".//assets/demo/chart-area-demo.js"></script>
    <script src=".//assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src=".//js/datatables-simple-demo.js"></script>
</body>

</html>

<?php
$conn->close();
?>