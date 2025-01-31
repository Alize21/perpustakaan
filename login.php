<?php 
include "functions.php";
session_start();

// cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {

    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash("sha384", $row["username"])) {
        $_SESSION["login"] = true;
    }

}

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
            
            // buat cookie
            if (isset($_POST["remember"])) {
                setcookie("id", $row["id"], time() + (86400 * 2));
                setcookie("key", hash("sha384", $row["username"]), time() + (86400 * 2));
            }

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
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
                <button type="submit" name="login">Login!</button>
                <button><a href="register.php">Register</a></button>
            </li>
            <?php if (isset($error)) :?>
                <p class="error">password atau username salah!</p>          
            <?php endif ?>
        </ul>
    </form>
</body>
</html>
