<?php  
include 'functions.php';
$books = query("SELECT * FROM books");

if (isset($_POST['submit'])) {
    
    if (insert() > 0) {
        echo "
            <script>
                alert('upload berhasil!');
                document.location.href = 'index.php';
            </script>
        ";
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
</head>
<body>
    
    <h1>Perpustakaan</h1>
    <button class="tambah-buku">tambah buku</button>
    
    <div class="container">
        <?php foreach( $books as $book ) : ?>
            <div class="item">
                <div class="thumb"><img src="img/<?= $book['gambar']?>" alt="thumb"></div>
                <div class="deskription">
                    <h1><?= $book["judul"] ?></h1>
                    <p><?= $book["dekripsi"] ?></p>
                    <a href="update.php?id=<?= $book["id"] ?>">edit</a>
                    <div class="categories">
                        <h4><?= $book["kategori"] ?></h4>
                        <h4><?= $book["penulis"] ?></h4>
                        <h4><?= $book["status"] ?></h4>
                        <a href="delete.php?id=<?= $book["id"] ?>&gambar=<?= $book['gambar']?>" onclick="return confirm('Hapus buku?')">hapus buku</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    
    <a href="register.php">Halaman register</a>

    <div class="insert-menu">
        <span href="" class="close">X</span>
        <form action="" method="post" enctype="multipart/form-data">

            <label for="judul_buku">Masukkan judul buku :   </label>
            <input type="text" name="judul_buku" id="judul_buku">

            <label for="penulis">Masukkan penulis buku :  </label>
            <input type="text" name="penulis" id="penulis">

            <label for="kategori">Masukkan kategori buku : </label>
            <input type="text" name="kategori" id="kategori">

            <label for="deskripsi">Masukkan deskripsi buku :</label>
            <input type="text" name="deskripsi" id="deskripsi" maxlength="350" placeholder="Maksimal 300 karakter">

            <input type="file" name="gambar" accept="image/jpg, image/jpeg, image/png">

            <button name="submit">Submit</button>
        </form>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>
