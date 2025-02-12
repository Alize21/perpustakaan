<?php 
include "functions.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}

$bookId = $_GET["id"];
$book = query("SELECT * FROM books WHERE id = $bookId")[0]; 

if ( isset($_POST["submit"]) ) {
    
    if (update($bookId) > 0) {
        // echo "
        //     <script>
        //         alert('update berhasil!');
        //         document.location.href = 'index.php';
        //     </script>
        // ";
        header("Location: login.php?user=" . $_GET["user"]);
    } else {
        echo "
            <script>
                alert('update gagal!');
            </script>
        ";
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update.css">
    <title>Update</title>
</head>
<body>

    <!-- navigation bar -->
    <nav>
        <a class="head" href="index.php?user=<?= $_GET["user"] ?>">Perpustakaan</a>
        <div class="navigation">
            <!-- <span class="tambah-buku">Tambah buku</span> -->
            <!-- <?php //$userId = $_GET["user"] ?> -->
            <!-- <h4><?= query("SELECT * FROM users WHERE id= '$userId'")[0]["username"] ?></h4> -->
            <!-- <a href="register.php">Halaman register</a> -->
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <form class="edit" action="" method="post" enctype="multipart/form-data">
        <h1>Edit informasi buku</h1>
        <input type="hidden" name="gambar" value="<?= $book["gambar"] ?>">
        <ul>
            <li>
                <img src="img/<?= $book["gambar"] ?>" width="80" alt="thumb"><br>
                <input type="file" name="gambar" accept="image/jpg, image/jpeg, image/png">
            </li>
            <li>            
                <label for="judul_buku">judul buku :   </label>
                <input type="text" name="judul_buku" id="judul_buku" value="<?= $book["judul"] ?>">
            </li>

            <li>
                <label for="penulis">penulis buku :  </label>
                <input type="text" name="penulis" id="penulis" value="<?= $book["penulis"] ?>">
            </li>

            <li>
                <label for="kategori">kategori buku : </label>
                <input type="text" name="kategori" id="kategori" value="<?= $book["kategori"] ?>">
            </li>

            <li>
                <label for="deskripsi">deskripsi buku :</label>
                <textarea name="deskripsi" id="deskripsi" maxlength="350" placeholder="Max 300 karakter" rows="5" cols="30"><?= $book["dekripsi"]?></textarea>
                <!-- <input type="text" name="deskripsi" id="deskripsi" maxlength="350" placeholder="Maksimal 300 karakter" value="<?= $book["dekripsi"] ?>"><br> -->
            </li>

            <li>
                <button type="submit" name="submit">Ubah!</button>
                <a href="index.php?user=<?=  $_GET["user"] ?>">Home page</a>
            </li>

            <!-- for debug only -->
            <li>
                <?php if (isset($error)) : ?>
                    <?=update($bookId) ?>
                <?php endif ?>
            </li>
        </ul>
    </form>

</body>
</html>