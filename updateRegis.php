<?php
include 'koneksi.php';

if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    // Hash password baru
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update data di database
    $query = "UPDATE register SET username = '$username', password = '$hashed_password' WHERE Id = '$id'";
    $update = mysqli_query($koneksi, $query);

    if ($update) {
        echo '<script>alert("Update Berhasil"); window.location="admin.php";</script>';
    } else {
        echo '<script>alert("Update Gagal: ' . mysqli_error($koneksi) . '"); window.location="admin.php";</script>';
    }
} else {
    echo '<script>alert("Data tidak lengkap!"); window.location="admin.php";</script>';
}

mysqli_close($koneksi);
?>
