<?php 
include "functions.php";

$bookId = $_GET["id"];
$book = query("SELECT * FROM books WHERE id = $bookId")[0]; 

if ( isset($_POST["submit"]) ) {
    
    if (update($bookId) > 0) {
        echo "
            <script>
                alert('update berhasil!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('update gagal!');
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
    <title>Update</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="gambar" value="<?= $book["gambar"] ?>">

        <label for="judul_buku">judul buku :   </label>
        <input type="text" name="judul_buku" id="judul_buku" value="<?= $book["judul"] ?>">

        <label for="penulis">penulis buku :  </label>
        <input type="text" name="penulis" id="penulis" value="<?= $book["penulis"] ?>">

        <label for="kategori">kategori buku : </label>
        <input type="text" name="kategori" id="kategori" value="<?= $book["kategori"] ?>">

        <label for="deskripsi">deskripsi buku :</label>
        <input type="text" name="deskripsi" id="deskripsi" maxlength="350" placeholder="Maksimal 300 karakter" value="<?= $book["dekripsi"] ?>"><br>

        <img src="img/<?= $book["gambar"] ?>" width="80" alt="thumb"><br>
        <input type="file" name="gambar" accept="image/jpg, image/jpeg, image/png">

        <button type="submit" name="submit">Ubah!</button>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>