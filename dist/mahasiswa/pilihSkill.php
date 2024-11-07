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

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">SPK Bidang Minat</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
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
                    <h3 class="mt-4">Pilih Skill</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pilih Skill</li>
                    </ol>
                </div>
                <div class="container mt-5">
                    <h5 class="mb-4">Form Ceklis Skill</h5>
                    <form action="handle_pilihSkill.php" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill1" name="skills[]" value="Analisa Sistem:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai1" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai1" value="0">
                                    <label class="form-check-label" for="skill1">Analisa Sistem</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill2" name="skills[]" value="Pengembangan Perangkat Lunak:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai2" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai2" value="0">
                                    <label class="form-check-label" for="skill2">Pengembangan Perangkat Lunak</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill3" name="skills[]" value="Manajemen Proyek Teknologi Informasi:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai3" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai3" value="0">
                                    <label class="form-check-label" for="skill3">Manajemen Proyek Teknologi Informasi</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill4" name="skills[]" value="Pengelolaan Basis Data:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai4" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai4" value="0">
                                    <label class="form-check-label" for="skill4">Pengelolaan Basis Data</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill5" name="skills[]" value="Trouble Shooting Jaringan:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai5" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai5" value="0">
                                    <label class="form-check-label" for="skill5">Trouble Shooting Jaringan</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill6" name="skills[]" value="Local Area Network:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai6" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai6" value="0">
                                    <label class="form-check-label" for="skill6">Local Area Network</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill7" name="skills[]" value="Administrasi Jaringan:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai7" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai7" value="0">
                                    <label class="form-check-label" for="skill7">Administrasi Jaringan</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill8" name="skills[]" value="Keamanan Jaringan dan Data:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai8" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai8" value="0">
                                    <label class="form-check-label" for="skill8">Keamanan Jaringan dan Data</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill9" name="skills[]" value="Pemrograman (Webphyton,Android):25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai9" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai9" value="0">
                                    <label class="form-check-label" for="skill9">Pemrograman (Webphyton,Android)</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill10" name="skills[]" value="Analisis dan Desain Perangkat Lunak:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai10" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai10" value="0">
                                    <label class="form-check-label" for="skill10">Analisis dan Desain Perangkat Lunak</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill11" name="skills[]" value="Pengembangan Perangkat Lunak Berbasis Proyek:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai11" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai11" value="0">
                                    <label class="form-check-label" for="skill11">Pengembangan Perangkat Lunak Berbasis Proyek</label>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="skill12" name="skills[]" value="Pengembangan Perangkat Lunak:25" onclick="updateCheckbox(this)">
                                    <input type="hidden" name="nilai12" value="0">
                                    <input type="hidden" class="hidden-skill" name="nilai12" value="0">
                                    <label class="form-check-label" for="skill12">Pengujian Perangkat Lunak</label>
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

    <script>
        function updateCheckbox(checkbox) {
            var hiddenInput = checkbox.parentNode.querySelector('.hidden-skill');
            if (checkbox.checked) {
                hiddenInput.value = 25;
            } else {
                hiddenInput.value = 0;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>