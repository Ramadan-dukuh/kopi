<?php
include 'koneksi.php';

// Mencegah SQL Injection
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Admin login tanpa database
if ($username == "admin" && $password == "admin") {
    echo '<script>alert("Login Berhasil")</script>';
    echo '<script>window.location="admin.php"</script>';
    exit;
}

// Query ke database untuk memeriksa username
$query = "SELECT * FROM register WHERE username = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Memeriksa apakah username ditemukan
if ($row = mysqli_fetch_assoc($result)) {
    // Verifikasi password (gunakan password_hash() saat menyimpan password di database)
    if (password_verify($password, $row['password'])) {
        // Jika login berhasil
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        echo '<script>alert("Login Berhasil")</script>';
        echo '<script>window.location="index.html"</script>';
    } else {
        // Jika password salah
        echo '<script>alert("Password salah!")</script>';
        echo '<script>window.location="login.html"</script>';
    }
} else {
    // Jika username tidak ditemukan
    echo '<script>alert("Username tidak ditemukan!")</script>';
    echo '<script>window.location="login.html"</script>';
}

mysqli_close($koneksi);
?>
