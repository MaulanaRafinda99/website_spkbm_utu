<?php
session_start();

// Menghapus semua data session
$_SESSION = array();

// Jika ada session cookie, hapus juga
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Akhir session
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit();
