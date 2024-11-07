<?php

// Konfigurasi Database
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "db_spkbm"; 

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}