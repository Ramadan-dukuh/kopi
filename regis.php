<?php
include 'koneksi.php';
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Hash password sebelum menyimpan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO register (id, username, password, time) VALUES ('', '$username', '$hashed_password', '');";
$insert = mysqli_query($koneksi, $query);

if ($insert) {
    echo '<script>alert("Register Berhasil")</script>';
    echo '<script>window.location="login.html"</script>';
} else {
    echo '<script>alert("Register Gagal")</script>';
    echo '<script>window.location="regis.html"</script>';
}
?>
