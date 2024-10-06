<?php
session_start(); // Start session untuk menyimpan cart

// Pastikan data 'name' dan 'counterValue' diterima melalui POST
if (isset($_POST['name']) && isset($_POST['counterValue'])) {
    $name = $_POST['name'];
    $quantity = (int)$_POST['counterValue']; // Pastikan ini angka

    // Buat array item baru
    $item = array(
        'name' => $name,
        'quantity' => $quantity
    );

    // Periksa apakah session cart sudah ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Buat session cart jika belum ada
    }

    // Periksa apakah item sudah ada di cart
    $item_exists = false;
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['name'] == $name) {
            // Jika item sudah ada, tambahkan jumlahnya
            $cart_item['quantity'] += $quantity;
            $item_exists = true;
            break;
        }
    }

    // Jika item belum ada di cart, tambahkan sebagai item baru
    if (!$item_exists) {
        $_SESSION['cart'][] = $item;
    }

    // Redirect ke halaman cart.php untuk melihat pesanan
    header("Location: cart.php");
    exit();
}
?>
