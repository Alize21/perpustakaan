<?php 
include "../functions.php";

$keyword = $_GET["keyword"];
$books = query("SELECT * FROM books WHERE judul LIKE '%$keyword%'")
?>

<?php if(count($books) == 0) : ?>
    <h1 class="content-not-found" style="text-align: center;">Content not found</h1>
<?php else : ?>
    <?php foreach( $books as $book ) : ?>
        <div class="item">
            <div class="thumb"><img src="img/<?= $book['gambar']?>" alt="thumb"></div>
            <div class="deskription">
                <a class="view" href="view.php?id=<?= $book["id"] ?>"><?= $book["judul"] ?></a>
                <div class="categories">
                    <h4><?= $book["kategori"] ?></h4>
                    <h4><?= $book["penulis"] ?></h4>
                    <h4><?= $book["status"] ?></h4>
                    <h4><a class="update" href="update.php?id=<?= $book["id"] ?>">Edit</a></h4>
                    <a href="delete.php?id=<?= $book["id"] ?>&gambar=<?= $book['gambar']?>" onclick="return confirm('Hapus buku?')">Delete book</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>