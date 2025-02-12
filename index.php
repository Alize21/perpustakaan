<?php  
include 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}

// cek admin (currently disabled)
$userId = $_GET["user"];
// $cekAdmin = query("SELECT * FROM users WHERE id = '$userId'")[0]["username"];
$cekAdmin = "admin";

$books = query("SELECT * FROM books");

if (isset($_POST['submit'])) {
    
    if (insert() > 0) {
        // echo "
        //     <script>
        //         alert('upload berhasil!');
        //         document.location.href = 'index.php';
        //     </script>
        // ";
        header("Location: login.php?user=" . $id);
    } else {
        echo "
            <script>
                alert('upload gagal!');
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
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/252cc19830.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <!-- navigation bar -->

    <nav>
        <a class="head" href="">Perpustakaan</a>
        <div class="navigation">

            <?php if ($cekAdmin === "admin") :?>
                <span class="tambah-buku">Tambah buku</span>
            <?php endif ?>

            <a href="logout.php">Logout</a>
            <span id="menu"><i class="fa-solid fa-bars"></i></span>
        </div>
        <div class="navbar">

            <?php if ($cekAdmin === "admin") :?>
                <span style="color: black;" class="tambah-buku-res">Tambah buku</span>
            <?php endif?>

            <a href="logout.php">Logout</a>
        </div>
    </nav>
 

    <!-- searchbar -->
     <div class="container">
        <div class="search-bar">
            <h1>Books</h1>
            <div class="input">
                <label for="keyword"><i class="fa-solid fa-magnifying-glass"></i></label>
                <input id="keyword" type="text" name="keyword" placeholder="Masukkan Judul buku" autocomplete="off" autofocus size="40">
            </div>
        </div>

        <!-- content -->
        <div class="content">
            <?php foreach( $books as $book ) : ?>
                <div class="item">
                    <div class="thumb"><img src="img/<?= $book['gambar']?>" alt="thumb"></div>
                    <div class="deskription">
                        <a class="view" href="view.php?id=<?= $book["id"] ?>&user=<?= $userId ?>"><?= $book["judul"] ?></a>
                        <div class="categories">
                            <h4><?= $book["kategori"] ?></h4>
                            <h4><?= $book["penulis"] ?></h4>
                            <h4><?= $book["status"] ?></h4>

                            <?php if ($cekAdmin === "admin") :?>
                                <h4><a class="update" href="update.php?id=<?= $book["id"] ?>&user=<?= $userId ?>">Edit</a></h4>
                                <a href="delete.php?id=<?= $book["id"] ?>&gambar=<?= $book['gambar']?>" onclick="return confirm('Hapus buku?')">Delete book</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        

        <div class="insert-menu">
            <h1>New book</h1>
            <span href="" class="close">X</span>
            <form action="" method="post" enctype="multipart/form-data">

                <ul>
                    <li>
                        <!-- <label for="judul_buku">Masukkan judul buku :   </label> -->
                        <input type="text" name="judul_buku" id="judul_buku" placeholder="judul buku" required>
                    </li>

                    <li>
                        <!-- <label for="penulis">Masukkan penulis buku :  </label> -->
                        <input type="text" name="penulis" id="penulis" placeholder="penulis buku" required>
                    </li>

                    <li>
                        <!-- <label for="kategori">Masukkan kategori buku : </label> -->
                        <input type="text" name="kategori" id="kategori" placeholder="kategori buku" required>
                    </li>

                    <li>
                        <!-- <label for="deskripsi">Masukkan deskripsi buku :</label> -->
                        <!-- <input type="text name="deskripsi" id="deskripsi" maxlength="350" placeholder="deskripsi buku (Max 300 karakter)" required> -->
                         <textarea name="deskripsi" id="deskripsi" rows="5" cols="30" placeholder="deskripsi buku (Max 300 karakter)" maxlength="350"></textarea>
                    </li>

                    <li>
                        <label for="inputFile">Gambar</label>
                        <input id="inputFile" type="file" name="gambar" accept="image/jpg, image/jpeg, image/png">
                    </li>
                    
                    <li>
                        <button name="submit">Submit</button>
                    </li>
                </ul>
                
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
