<?php
include '../config.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    // Menampilkan konfirmasi penghapusan
    echo "<script>
        var confirmDelete = confirm('Apakah Anda yakin ingin menghapus data mahasiswa dengan NIM $nim?');
        if (confirmDelete) {
            window.location.href = 'hapus_mahasiswa.php?confirm=true&nim=$nim';
        } else {
            window.location.href = 'index.php';
        }
    </script>";
} else {
    echo "NIM Tidak Ditemukan";
}

$conn->close();
