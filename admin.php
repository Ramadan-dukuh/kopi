<?php
include 'koneksi.php';
$query = "SELECT * FROM register";
$result = mysqli_query($koneksi, $query);
$jumlah = mysqli_num_rows($result);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>☕ OAT |Admin</title>
</head>
<body>
<nav>
        <div class="logo"><a href="index.html"><B>OAT</B></a></div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="pesanan.php">Buy a Coffee</a></li>
            <details>
                <summary>Login</summary>
                <ul>
                    <li>Akun</li>
                    <li>Setting</li>
                    <li><a href="login.html">Logout</a></li>
                </ul>
            </details>
        </ul>
    </nav>
<table class="table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <?php
            for($i = 0; $i < $jumlah; $i++){
                $row = mysqli_fetch_array($result);
                ?>
                <tr>
                    <td><?=$row["Id"]?></td>
                    <td><?=$row["username"]?></td>
                    <td><?=$row["password"]?></td>
                    <td><?=$row["time"]?></td>
                    <td>
                    <button type="button" class="btn-edit"><a href="editRegis.php?id=<?=$row['Id']?>">EDIT</a></button>
                        <button type="button" class="btn-delete"><a href="deleteRegis.php?id=<?=$row['Id']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">DELETE</a></button>
                    </td>
                </tr>
                <?php
            }
       ?>
</table>
</body>
</html>