<?php
include '../config.php';

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM alternatif WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Berhasil Menghapus Alternatif'); window.location.href='alternatif.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
