<?php
session_start(); // Mulai session untuk akses cart
include 'koneksi.php'; // Koneksi ke database

// Fungsi untuk menghapus item dari cart
if (isset($_GET['remove'])) {
    $remove_item = $_GET['remove'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['name'] == $remove_item) {
            unset($_SESSION['cart'][$key]); // Hapus item dari session cart
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset index array
            break;
        }
    }
}

// Fungsi untuk checkout
if (isset($_POST['checkout'])) {
    // Periksa jika cart tidak kosong
    if (!empty($_SESSION['cart'])) {
        // Loop melalui semua item di cart untuk menyimpannya ke database
        foreach ($_SESSION['cart'] as $item) {
            $name = $item['name'];
            $quantity = $item['quantity'];

            // Simpan data pesanan ke database
            $query = "INSERT INTO pesanan (Id,barang, jumlah, time) VALUES ('','$name', '$quantity', NOW())";
            mysqli_query($koneksi, $query); // Eksekusi query
        }

        // Kosongkan cart setelah checkout
        unset($_SESSION['cart']);

        // Tampilkan pesan sukses
        echo '<script>alert("Pesanan Berhasil!"); window.location="index.html";</script>';
        exit();
    } else {
        echo '<script>alert("Keranjang Anda kosong.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .table{
    width: 100%;
    border-collapse: collapse;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}
.table th,td{
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.table th{
    background-color: var(--primary-color);
    color: var(--secondary-color);
}
.btn{
    background-color: var(--primary-color);
    color: var(--secondary-color);
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    outline: none;
}
    </style>
    <title>Keranjang Belanja</title>
</head>
<body>
    <h1>Keranjang Belanja</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table border="1" class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><a href="cart.php?remove=<?php echo $item['name']; ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tombol Checkout -->
        <form action="cart.php" method="post">
            <button type="submit" name="checkout" class="btn">Checkout</button>
        </form>

    <?php else: ?>
        <p>Keranjang Anda kosong.</p>
    <?php endif; ?>

    <a href="coffe.html">Kembali Belanja</a>
</body>
</html>
