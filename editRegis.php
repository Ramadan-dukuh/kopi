<?php
include 'koneksi.php';

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil data dari database berdasarkan ID
    $query = "SELECT * FROM register WHERE Id = '$id'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Jika data ditemukan
    if ($row) {
        $username = $row['username'];
        $password = $row['password']; // Pastikan ini hashed password
    } else {
        echo '<script>alert("User tidak ditemukan!"); window.location="admin.php";</script>';
    }
} else {
    echo '<script>alert("ID tidak ditemukan!"); window.location="admin.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,500;0,800;1,500&display=swap");

:root {
  --primary-color: #323c39;
  --secondary-color: #d3c9a1;
}

html,
body,
* {
  margin: 0;
  padding: 0;
  /* font-family: 'Lato', sans-serif; */
  font-family: "Poppins", sans-serif;
  box-sizing: border-box;
  scroll-behavior: smooth;
}
    .form{
    width: 300px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    border-radius: 10px;
    background-color: #fff;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;
  }
.form h2{
    text-align: center;
    color: #222;
    margin: 10px 0px 20px;
    font-size: 25px;
  }
.form .form-element{
    margin: 15px 0px;
  }
.form .form-element label{
    font-size: 14px;
    color: #777;
  }
.form .form-element input[type="email"],
.form .form-element input[type="password"],
.form .form-element input[type="text"]{
    margin-top: 5px;
    display: block;
    width: 100%;
    padding: 10px;
    outline: none;
    border: 1px solid #ccc;
    border-radius: 5px;    
    margin: 10px;
  }
  .password-toggle-icon {
    position: absolute;
    top: 229px;
    right: 30px;
    transform: translateY(-50%);
    cursor: pointer;
  }
  
  .password-toggle-icon i {
    font-size: 18px;
    line-height: 1;
    color: #333;
    transition: color 0.3s ease-in-out;
    margin-bottom: 20px;
  }
  
  .password-toggle-icon i:hover {
    color: #000;
  }
.form .form-element input[type="email"]{
    margin-right: 5px;
  }
.form .form-element button{
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    font-size: 16px;
    color: #fff;
    background: #222;
    cursor: pointer;
    border-radius: 10px;
  }
  .form .form-element a{
    display: block;
    text-align: right;
    font-size: 15px;
    color: #1a79ca;
    text-decoration: none;
    font-weight: 600;
  }
  .form .form-element p{
    display: block;
    text-align: right;
    font-size: 15px;
    color: #222;
    text-decoration: none;
    font-weight: 600;
  }
.btn{
    background-color: var(--primary-color);
    color: var(--secondary-color);
    padding: 5px 10px;
    border-radius: 5px;
    text-align: center;
}
</style>
    <title>Edit User</title>
</head>
<body>
    <form action="updateRegis.php" method="POST">
        <div class="form">
            <h2>Edit User</h2>
            <div class="form-element">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?= $username; ?>" required>
                
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                
                <button type="submit" class="btn">Update</button>
                <button type="button" class="btn"><a href="admin.php">Back</a></button>
            </div>
        </div>
    </form>
</body>
</html>
