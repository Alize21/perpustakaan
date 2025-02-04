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
            // header("Location: index.php?user=" . $row["id"]);
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
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/252cc19830.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Login Form</h1>
        <form action="" method="post">
            <ul>
                <li class="input">
                    <label for="username"><i class="fa-solid fa-user"></i></label>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </li>

                <li class="input">
                    <label for="password"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </li>

                <?php if (isset($error)) :?>
                    <li>
                        <p class="error">Account does not exist or wrong password and username</p>  
                    </li>        
                <?php endif ?>

                <li>
                    <button class="button" type="submit" name="login">Login!</button>
                </li>

                <li>
                    <input class="cookie" type="checkbox" name="remember" id="remember">
                    <label class="cookie" for="remember">Remember me</label>
                </li>

                <li>
                    <p>Not a member? <a href="register.php">Sign-up now!</a></p>
                </li>
                    
            </ul>
        </form>
    </div>
</body>
</html>
