<?php  
include 'functions.php';
$books = query("SELECT * FROM books")
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

    <div class="container">
        <?php foreach( $books as $book ) : ?>
            <div class="item">
                <h1><?= $book['judul'] ?></h1>
            </div>
            <div class="item">
                <h1>test2</h1>
            </div>
        <?php endforeach ?>
    </div>

</body>
</html>