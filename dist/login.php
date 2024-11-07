<?php
include 'config.php';

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['nim']) && isset($_POST['password'])) {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    // Hindari SQL Injection dengan menggunakan prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE nim = ?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user['password'])) {
        $_SESSION['nim'] = $nim;
        header("Location: mahasiswa/index.php");
        exit();
      } else {
        $error = "Username atau password salah!";
      }
    } else {
      $error = "Username atau password salah!";
    }
  } else {
    $error = "Silakan masukkan username dan password!";
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

  <link rel="stylesheet" href="css/style.css">

  <!-- MATERIAL DESIGN ICONIC FONT -->
  <link href="{{ asset('fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}"
    rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Font Awesome CDN -->

  <title>SPKBM | Login Mahasiswa</title>
</head>


<body>
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h4 class="text-center text-dark mt-5">Login SPKBM</h4>
          <div class="card my-3">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="card-body cardbody-color p-lg-4">
              <div class="text-center">
                <img src="assets/img/profile.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile" />
              </div>

              <div class="mb-3">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required />
              </div>
              <div class="mb-3">
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
                <button type="submit" class="btn btn-color px-5 mb-2 w-80">Login</button>
                <?php
                // Menampilkan pesan error jika terjadi kesalahan saat login
                if (!empty($error)) {
                  echo "<p class='text-danger'>$error</p>";
                }
                ?>
              </div>

              <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                Belum punya akun?
                <a href="mahasiswa/register.php" class="text-dark fw-bold"> Daftar!</a>
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