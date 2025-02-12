<?php 
include "functions.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$bookId = $_GET["id"];
$book = query("SELECT * FROM books WHERE id = '$bookId'")[0];
?>

<!DOCTYPE html>
<html lang="css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/view.css">
</head>
<body>

    <!-- navigation bar -->
    <nav>
        <a class="head" href="index.php?user=<?= $_GET["user"] ?>">Perpustakaan</a>
        <div class="navigation">
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Book details</h2>
        <div class="thumb">
            <div><img src="img/<?= $book["gambar"] ?>" alt="thumb"></div>
            <h1><?= $book["judul"] ?></h1>
        </div>
        <h2>Book description</h2>
        <table>
            <tr>
                <td class="title">Judul</td>
                <td><?= $book["judul"] ?></td>
            </tr>

            <tr>
                <td class="title">Penulis</td>
                <td><?= $book["penulis"] ?></td>
            </tr>

            <tr>
                <td class="title">Kategori</td>
                <td><?= $book["kategori"] ?></td>
            </tr>

            <tr>
                <td class="title">Uraian</td>
                <td><?= $book["dekripsi"] ?></td>
            </tr>
        </table>
    </div>
</body>
</html>