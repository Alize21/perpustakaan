<?php 
$conn = mysqli_connect('localhost', 'root', '', 'perpustakaan');

function query($query) {
    global $conn;
    $books = [];
    $result = mysqli_query($conn, $query);
    while ( $book = mysqli_fetch_assoc($result) ) {
        array_push($books, $book);
    }

    return $books;
}
?>