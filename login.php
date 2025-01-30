<?php 
include "functions.php";
session_start();

// arahkan user ke halaman utama jika ada session
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {

    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    
    if (mysqli_num_rows($user) === 1) {
        $row = mysqli_fetch_assoc($user);
    
        if (password_verify($password, $row["password"])) {
            
            $_SESSION["login"] = true;
            header("Location: index.php");
            exit;
        }

    }
 
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error {
            font-style: italic;
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username">
            </li>

            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </li>

            <li>
                <button type="submit" name="login">Login!</button>
                <button><a href="register.php">register</a></button>
            </li>
            <?php if (isset($error)) :?>
                <p class="error">password atau username salah!</p>          
            <?php endif ?>
        </ul>
    </form>
</body>
</html>
