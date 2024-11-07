<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Menampilkan konfirmasi penghapusan
    echo "<script>
        var confirmDelete = confirm('Apakah Anda yakin ingin menghapus alternatif ini ?');
        if (confirmDelete) {
            window.location.href = 'hapus_alternatif.php?confirm=true&id=$id';
        } else {
            window.location.href = 'alternatif.php';
        }
    </script>";
} else {
    echo "ID Alternatif Tidak Ditemukan";
}

$conn->close();
