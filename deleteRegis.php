<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    // Ambil ID dari URL dengan metode GET
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Hapus data dari database berdasarkan ID
    $query = "DELETE FROM register WHERE Id = '$id'";
    $delete = mysqli_query($koneksi, $query);

    if ($delete) {
        echo '<script>alert("Delete Berhasil")</script>';
        echo '<script>window.location="admin.php"</script>';
    } else {
        echo '<script>alert("Delete Gagal: ' . mysqli_error($koneksi) . '")</script>';
        echo '<script>window.location="admin.php"</script>';
    }
} else {
    echo '<script>alert("ID tidak ditemukan!")</script>';
    echo '<script>window.location="admin.php"</script>';
}

mysqli_close($koneksi);
?>
