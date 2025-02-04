<?php 
include "../functions.php";

$keyword = $_GET["keyword"];
$books = query("SELECT * FROM books WHERE judul LIKE '%$keyword%'")
?>

<?php if(count($books) == 0) : ?>
    <h1 class="content-not-found" style="text-align: center;">Data tidak ditemukan</h1>
<?php else : ?>
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
<?php endif ?>