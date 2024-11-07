<?php
include '../config.php';

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true' && isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "DELETE FROM users WHERE nim = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nim);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Berhasil Menghapus Data Mahasiswa'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>