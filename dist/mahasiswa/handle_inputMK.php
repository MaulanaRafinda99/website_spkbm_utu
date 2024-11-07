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
$course1 = $_POST['course1'];
$course2 = $_POST['course2'];
$course3 = $_POST['course3'];
$course4 = $_POST['course4'];
$course5 = $_POST['course5'];
$course6 = $_POST['course6'];
$course7 = $_POST['course7'];
$course8 = $_POST['course8'];
$course9 = $_POST['course9'];

// Hitung rata-rata
$sistem_informasi_avg = ($course1 + $course2 + $course3) / 3;
$jaringan_komputer_avg = ($course4 + $course5 + $course6) / 3;
$rekayasa_perangkat_lunak_avg = ($course7 + $course8 + $course9) / 3;

// Query untuk menyimpan atau mengupdate data ketika data sudah ada.
$sql = "INSERT INTO nilai_mk (nim, nama, nilaiSI, nilaiJ, nilaiRPL) VALUES (?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE nilaiSI = VALUES(nilaiSI), nilaiJ = VALUES(nilaiJ), nilaiRPL = VALUES(nilaiRPL)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddd", $nim, $nama, $sistem_informasi_avg, $jaringan_komputer_avg, $rekayasa_perangkat_lunak_avg);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'pilihSkill.php';</script>";
} else {
    // Jika gagal untuk melakukan insert karena duplikat, maka lakukan update
    $sql_update = "UPDATE nilai_mk SET nilaiSI = ?, nilaiJ = ?, nilaiRPL = ? WHERE nim = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("dddi", $sistem_informasi_avg, $jaringan_komputer_avg, $rekayasa_perangkat_lunak_avg, $nim);
    if ($stmt_update->execute()) {
        echo "<script>alert('Data berhasil diupdate.'); window.location.href = 'pilihSkill.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

$stmt->close();
$stmt_update->close();
$conn->close();
