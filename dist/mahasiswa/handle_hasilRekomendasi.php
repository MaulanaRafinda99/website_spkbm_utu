<?php
session_start();
include '../config.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit();
}

// Ambil NIM dari sesi
$nim = $_SESSION['nim'];

// Query untuk mengambil data pengguna
$sql = "SELECT * FROM users WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nim); // menggunakan "s" karena nim mungkin berupa string
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama = $user['nama'];

// Ambil data dari form
$hasilRekomendasi = $_POST['hasilRekomendasi'];

// Query untuk menyimpan atau mengupdate data ketika data sudah ada.
$sql = "INSERT INTO hasil_rekomendasi (nim, nama, hasil) VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE hasil = VALUES(hasil)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nim, $nama, $hasilRekomendasi);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'index.php';</script>";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$stmt->close();
$conn->close();
?>