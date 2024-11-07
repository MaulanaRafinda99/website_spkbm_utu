<?php
include '../config.php';

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true' && isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "DELETE FROM hasil_rekomendasi WHERE nim = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nim);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Berhasil Menghapus Hasil Rekomendasi Mahasiswa'); window.location.href='data_hasilRekomendasi.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
