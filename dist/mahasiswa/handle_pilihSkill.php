<?php
include '../config.php';
session_start();

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
$stmt->bind_param("i", $nim);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$nama = $user['nama'];

// Ambil data dari form
$skills = isset($_POST['skills']) ? $_POST['skills'] : [];

// Pisahkan nama skill dan nilai skill
$namaSkills = [];
$nilaiSkills = [];

foreach ($skills as $skill) {
    $splitSkill = explode(":", $skill);
    $namaSkill = $splitSkill[0];
    $nilaiSkill = $splitSkill[1];
    $namaSkills[] = $namaSkill;
    $nilaiSkills[] = (int)$nilaiSkill;
}

/// Ambil nilai skill untuk setiap bidang
$nilaiSkill1 = isset($_POST['nilai1']) ? $_POST['nilai1'] : 0;
$nilaiSkill2 = isset($_POST['nilai2']) ? $_POST['nilai2'] : 0;
$nilaiSkill3 = isset($_POST['nilai3']) ? $_POST['nilai3'] : 0;
$nilaiSkill4 = isset($_POST['nilai4']) ? $_POST['nilai4'] : 0;
$nilaiSkill5 = isset($_POST['nilai5']) ? $_POST['nilai5'] : 0;
$nilaiSkill6 = isset($_POST['nilai6']) ? $_POST['nilai6'] : 0;
$nilaiSkill7 = isset($_POST['nilai7']) ? $_POST['nilai7'] : 0;
$nilaiSkill8 = isset($_POST['nilai8']) ? $_POST['nilai8'] : 0;
$nilaiSkill9 = isset($_POST['nilai9']) ? $_POST['nilai9'] : 0;
$nilaiSkill10 = isset($_POST['nilai10']) ? $_POST['nilai10'] : 0;
$nilaiSkill11 = isset($_POST['nilai11']) ? $_POST['nilai11'] : 0;
$nilaiSkill12 = isset($_POST['nilai12']) ? $_POST['nilai12'] : 0;

// Hitung rata-rata nilai untuk setiap bidang skill
$sistem_informasi_avg = $nilaiSkill1 + $nilaiSkill2 + $nilaiSkill3 + $nilaiSkill4;
$jaringan_komputer_avg = $nilaiSkill5 + $nilaiSkill6 + $nilaiSkill7 + $nilaiSkill8;
$rekayasa_perangkat_lunak_avg = $nilaiSkill9 + $nilaiSkill10 + $nilaiSkill11 + $nilaiSkill12;



// Konversi array ke string terpisah koma
$namaSkillsString = implode(", ", $namaSkills);
$nilaiSkillsString = implode(", ", $nilaiSkills);

// Query untuk menyimpan atau mengupdate data ketika data sudah ada.
$sql = "INSERT INTO nilai_skill (nim, nama, namaSkill, nilaiSI, nilaiJ, nilaiRPL) 
        VALUES (?, ?, ?, ?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
            namaSkill = VALUES(namaSkill), 
            nilaiSI = VALUES(nilaiSI),
            nilaiJ = VALUES(nilaiJ),
            nilaiRPL = VALUES(nilaiRPL)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssddd", $nim, $nama, $namaSkillsString, $sistem_informasi_avg, $jaringan_komputer_avg, $rekayasa_perangkat_lunak_avg);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'pilihMinat.php';</script>";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$stmt->close();
$conn->close();
