<?php
include '../config.php';

error_reporting(0); // Menyembunyikan semua error

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

$stmt->close();

// Menghitung metode ELECTRE
$w = [3.0, 2.0, 1.0]; // bobot untuk setiap kriteria
$alternatif = [
	'Sistem Informasi' => [$nilaiSI, $nilaiSIMK, $minatSI],
	'Jaringan' => [$nilaiJ, $nilaiJMK, $minatJ],
	'Rekayasa Perangkat Lunak' => [$nilaiRPL, $nilaiRPLMK, $minatRPL]
];


// Tahapan Normalisasi
function normalize_matrix($alternatif)
{
	$normalized = [];
	$sums = array_fill(0, count(current($alternatif)), 0);

	// Hitung jumlah kuadrat untuk setiap kolom (kriteria)
	foreach ($alternatif as $values) {
		foreach ($values as $j => $value) {
			$sums[$j] += $value * $value;
		}
	}

	// Normalisasi setiap elemen matriks
	foreach ($alternatif as $key => $values) {
		foreach ($values as $j => $value) {
			$denominator = sqrt($sums[$j]);
			$normalized[$key][$j] = $denominator == 0 ? 0 : $value / $denominator;
		}
	}

	return $normalized;
}

$normalized = normalize_matrix($alternatif);


// Pembobotan hasil normalisasi
function weight_matrix($normalized, $w)
{
	$weighted = [];
	foreach ($normalized as $key => $values) {
		foreach ($values as $j => $value) {
			$weighted[$key][$j] = $value * $w[$j];
		}
	}
	return $weighted;
}

$weighted = weight_matrix($normalized, $w);


// Menentukan Matrix Concordance & Discordance
function concordance_discordance($weighted)
{
	$concordance = [];
	$discordance = [];
	$keys = array_keys($weighted);
	$n = count($keys);

	for ($i = 0; $i < $n; $i++) {
		for ($j = 0; $j < $n; $j++) {
			if ($i != $j) {
				$C = 0;
				$D = 0;
				$max_diff = 0;
				$diffs = [];

				// Concordance 
				for ($k = 0; $k < count($weighted[$keys[$i]]); $k++) {
					if ($weighted[$keys[$i]][$k] >= $weighted[$keys[$j]][$k]) {
						$C += $weighted[$k];
					} else {
						// Discordance 
						$diff = abs($weighted[$keys[$i]][$k] - $weighted[$keys[$j]][$k]);
						$D += $diff;
						$diffs[] = $diff;
						if ($diff > $max_diff) {
							$max_diff = $diff;
						}
					}
				}

				$concordance[$keys[$i]][$keys[$j]] = $C;
				$discordance[$keys[$i]][$keys[$j]] = $max_diff == 0 ? 0 : $D / $max_diff;
			}
		}
	}

	return [$concordance, $discordance];
}

list($concordance, $discordance) = concordance_discordance($weighted);


// Dominan Matrix
function domain_matrices($concordance, $discordance)
{
	$concordance_domain = [];
	$discordance_domain = [];
	$keys = array_keys($concordance);
	$n = count($keys);

	$C_threshold = array_sum(array_map('array_sum', $concordance)) / ($n * ($n - 1));
	$D_threshold = array_sum(array_map('array_sum', $discordance)) / ($n * ($n - 1));

	for ($i = 0; $i < $n; $i++) {
		for ($j = 0; $j < $n; $j++) {
			if ($i != $j) {
				$concordance_domain[$keys[$i]][$keys[$j]] = $concordance[$keys[$i]][$keys[$j]] >= $C_threshold ? 1 : 0;
				$discordance_domain[$keys[$i]][$keys[$j]] = $discordance[$keys[$i]][$keys[$j]] <= $D_threshold ? 1 : 0;
			}
		}
	}

	return [$concordance_domain, $discordance_domain];
}

list($concordance_domain, $discordance_domain) = domain_matrices($concordance, $discordance);


// Perhitungan Agregate
function aggregate_dominance_matrix($concordance_domain, $discordance_domain)
{
	$aggregate = [];
	$keys = array_keys($concordance_domain);
	$n = count($keys);

	for ($i = 0; $i < $n; $i++) {
		for ($j = 0; $j < $n; $j++) {
			if ($i != $j) {
				$aggregate[$keys[$i]][$keys[$j]] = $concordance_domain[$keys[$i]][$keys[$j]] * $discordance_domain[$keys[$i]][$keys[$j]];
			}
		}
	}
	return $aggregate;
}

$aggregate = aggregate_dominance_matrix($concordance_domain, $discordance_domain);

function rank_alternatives($aggregate)
{
	$ranking = [];
	$keys = array_keys($aggregate);

	foreach ($keys as $i) {
		$ranking[$i] = array_sum($aggregate[$i]);
	}

	arsort($ranking);
	return $ranking;
}


// Perangkingan hasil perangkingan
$ranking = rank_alternatives($aggregate); 

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
					<h3 class="mt-4">Hasil Rekomendasi</h3>
					<ol class="breadcrumb mb=4">
						<li class="breadcrumb-item active">Hasil Rekomendasi</li>
					</ol>
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


					
						<form action="handle_hasilRekomendasi.php" method="POST">
							<div class="container-fluid px-4">
								<h5 class="mt-4">Rangking</h5>
								<?php
								$first_alt = key($ranking); // Mengambil nama alternatif pertama
								?>
								<p>Hasil Rekomendasi Bidang Minat: <button class="btn btn-secondary mb-4"><?php echo htmlspecialchars($first_alt); ?></button></p>
								<input type="hidden" name="hasilRekomendasi" value="<?php echo htmlspecialchars($first_alt); ?>">
								<button class="btn btn-primary mb-4" style="display: flex; justify-content: flex-end;">Simpan Hasil Rekomendasi</button>
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
	<script src="../js/scripts.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	<script src="../assets/demo/chart-area-demo.js"></script>
	<script src="../assets/demo/chart-bar-demo.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
	<script src="../js/datatables-simple-demo.js"></script>
</body>

</html>