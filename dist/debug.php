<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Artikel tidak ditemukan.";
    }
} else {
    echo "ID artikel tidak disediakan.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Detail Artikel</title>
</head>

<body>
    <?php if (!empty($user)) : ?>
        <h2><?php echo $user['nama']; ?></h2>
        <p>NIM: <?php echo $user['nim']; ?></p>
       
    <?php endif; ?>
</body>

</html>

<?php
$conn->close();
?>