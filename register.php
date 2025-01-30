<?php 
include "functions.php";
session_start();

if (isset($_POST["register"])) {

    if (register() > 0) {
        echo "
            <script>
                alert('register berhasil!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('register gagal!');
            </script>
        ";
    }

}
?>
<!DOCTYPE html>
<html lang="css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Confirm password : </label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button name="register">Register!</button>
            </li>
            <button><a href="login.php">kembali ke halaman login</a></button>
        </ul>
    </form>

</body>
</html>