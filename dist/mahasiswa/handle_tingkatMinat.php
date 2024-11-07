<?php
session_start();
include '../config.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna, NIM, dan nama dari sesi
$nim = $_SESSION['nim'];

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama = $user['nama'];

// Ambil data dari form
$sistemInformasi = $_POST['sistemInformasi'];
$jaringan = $_POST['jaringan'];
$rekayasaPerangkatLunak = $_POST['rekayasaPerangkatLunak'];

// Query untuk menyimpan atau mengupdate data ketika data sudah ada.
$sql = "INSERT INTO tingkat_minat (nim, nama, minatSI, minatJ, minatRPL) VALUES (?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE minatSI = VALUES(minatSI), minatJ = VALUES(minatJ), minatRPL = VALUES(minatRPL)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddd", $nim, $nama, $sistemInformasi, $jaringan, $rekayasaPerangkatLunak);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'lihatRekomendasi.php';</script>";
} else {
    // Jika gagal untuk melakukan insert karena duplikat, maka lakukan update
    $sql_update = "UPDATE tingkat_minat SET minatSI = ?, minatJ = ?, minatRPL = ? WHERE nim = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("dddi", $sistemInformasi, $jaringan, $rekayasaPerangkatLunak, $nim);
    if ($stmt_update->execute()) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'lihatRekomendasi.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

$stmt->close();
$stmt_update->close();
$conn->close();
