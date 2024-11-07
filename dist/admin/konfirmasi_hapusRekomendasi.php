<?php
include 'config.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    // Menampilkan konfirmasi penghapusan
    echo "<script>
        var confirmDelete = confirm('Apakah Anda yakin ingin menghapus hasil rekomendasi untuk mahasiswa dengan nim = $nim?');
        if (confirmDelete) {
            window.location.href = 'hapus_rekomendasi.php?confirm=true&nim=$nim';
        } else {
            window.location.href = 'data_hasilRekomendasi.php';
        }
    </script>";
} else {
    echo "NIM Tidak Ditemukan";
}

$conn->close();
