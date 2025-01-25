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

function insert() {
    global $conn;
    $judul = htmlspecialchars($_POST["judul_buku"]);
    $penulis = htmlspecialchars($_POST["penulis"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);

    $foto = upload();

    mysqli_query($conn, "INSERT INTO books VALUES ('', '$judul', '$foto', '$penulis', '$kategori', '$deskripsi', 'tersedia')");
    return mysqli_affected_rows($conn);
}

function deleteItem($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM books WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function upload() {
    $gambar = $_FILES['gambar'];

    // jika tidak ada gambar yang diupload
    if ($gambar['error'] == 4) {
        echo "
            <script>
                alert('tidak ada gambar yang diupload');
            </script>
        ";
        return false;

    }

    // jika ukuran gambar lebih dari 2 megabyte
    if ( $gambar['size'] > 2000000 ) {
        echo "
            <script>
                alert('ukuran gambar harus kurang dari 2mb');
            </script>
        ";
        return false;
    }

    $isValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = pathinfo($gambar['name'], PATHINFO_EXTENSION);
    // cek ektensi gambar
    if (in_array($ekstensiGambar, $isValid)) {
        $newNamaFile = uniqid().'.'.$ekstensiGambar; // mencegah nama gambar sama
        move_uploaded_file($gambar['tmp_name'], 'img/'.$newNamaFile);
    } else {
        echo "
            <script>
                alert('file yang diupload bukan gambar');
            </script>
        ";
        return false;
    }

    return $newNamaFile;
}
?>