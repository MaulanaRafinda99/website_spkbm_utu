<?php
session_start();

include '../config.php';


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hindari SQL Injection dengan menggunakan prepared statements
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();

      if ($password == $user['password']) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
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

  <link rel="stylesheet" href="../css/style.css">

  <title>SPKBM | Login Admin</title>
</head>


<body>
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h4 class="text-center text-dark mt-5">Admin Login SPKBM</h4>
          <div class="card my-3">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="card-body cardbody-color p-lg-4">
              <div class="text-center">
                <img src="../assets/img/profile.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile" />
              </div>

              <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
              </div>
              <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
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
              <div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>