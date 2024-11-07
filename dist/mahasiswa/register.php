<?php

// Include file konfigurasi
include '../config.php';

// Inisialisasi variabel error
$error = "";
$success = "";

// Mengecek apakah form register sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mengecek apakah semua data di-submit
  if (isset($_POST['nama']) && isset($_POST['password']) && isset($_POST['nim'])) {
    // Mendapatkan data yang diinputkan dari form
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $nim = $_POST['nim'];

    // Mencegah SQL Injection
    $nama = $conn->real_escape_string($nama);
    $password = $conn->real_escape_string($password);
    $nim = $conn->real_escape_string($nim);

    // Pengecekan apakah NIM sudah terdaftar
    $check_nim_query = "SELECT nim FROM users WHERE nim = '$nim'";
    $result = $conn->query($check_nim_query);

    if ($result->num_rows > 0) {
      // Jika NIM sudah terdaftar, tampilkan pesan error
      echo "<script>alert('NIM sudah terdaftar! Silakan gunakan NIM yang lain.'); window.location.href='../mahasiswa/register.php';</script>";
    } else {
      // Mengenkripsi password
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      // Query untuk memasukkan data pengguna baru
      $sql = "INSERT INTO users (nama, nim, password) VALUES ('$nama', '$nim', '$hashed_password')";

      if ($conn->query($sql) === TRUE) {
        // Jika berhasil, tampilkan pesan sukses dan beralih ke halaman login
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='../login.php';</script>";
        exit();
      } else {
        // Jika gagal, tampilkan pesan error
        $error = "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>alert('$error');</script>";
      }
    }
  } else {
    // Jika form tidak lengkap, tampilkan pesan error
    $error = "Silakan lengkapi semua field!";
    echo "<script>alert('$error');</script>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap Link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

  <link rel="stylesheet" href="../css/style.css">

  <!-- MATERIAL DESIGN ICONIC FONT -->
  <link href="{{ asset('fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Font Awesome CDN -->

  <title>SPKBM | Register Page</title>
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h4 class="text-center text-dark mt-5">Registrasi Akun</h4>
          <div class="card my-3">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="card-body cardbody-color p-lg-5">
              <div class="text-center">
                <img src="../assets/img/profile.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile" />
              </div>

              <div class="mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Nama" required />
              </div>


              <div class="mb-3">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim"  placeholder="NIM" required />
              </div>

              <div class="mb-3 form-wrapper">
                <div class="input-container">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required />
                  <a href="#" class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="far fa-eye" id="togglePassword"></i>
                  </a>
                </div>

                <style>
                  .input-container {
                    position: relative;
                    width: 100%;
                  }

                  .form-control {
                    width: 100%;
                    padding-right: 40px;
                    /* Space for the eye icon */
                  }

                  .toggle-password {
                    position: absolute;
                    right: 10px;
                    top: 75%;
                    transform: translateY(-50%);
                    cursor: pointer;
                    color: #999;
                  }

                  .toggle-password i {
                    font-size: 18px;
                  }
                </style>

              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-color px-5 mb-5 w-100">
                  Daftar
                </button>
              </div>
              <?php
              // Menampilkan pesan error atau sukses jika ada
              if (!empty($error)) {
                echo "<p>$error</p>";
              }
              if (!empty($success)) {
                echo "<p>$success</p>";
              }
              ?>
              <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                Sudah punya akun
                <a href="../login.php" class="text-dark fw-bold"> Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    var icon = document.getElementById('togglePassword');

    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove('far', 'fa-eye');
      icon.classList.add('fas', 'fa-eye-slash');
    } else {
      passwordField.type = "password";
      icon.classList.remove('fas', 'fa-eye-slash');
      icon.classList.add('far', 'fa-eye');
    }
  }
</script>

</html>