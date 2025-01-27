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


function deleteItem($id, $foto) {
    global $conn;

    if (file_exists("img/" . $foto)) {
        unlink("img/" . $foto);  
    }
    mysqli_query($conn, "DELETE FROM books WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function update($id) {
    global $conn;

    $judul = htmlspecialchars($_POST["judul_buku"]);
    $penulis = htmlspecialchars($_POST["penulis"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);

    // jika user tidak mengupload gambar
    if ($_FILES["gambar"]["error"] === 4) {
        $foto = $_POST["gambar"]; // pakai gambar sebelumnya
    } else {
        if (file_exists("img/" . $_POST["gambar"])) {
            unlink("img/" . $_POST["gambar"]);  
        }
        $foto = upload();
    }

    mysqli_query(
        $conn, "UPDATE books SET judul = '$judul', gambar= '$foto', penulis= '$penulis', kategori= '$kategori', dekripsi= '$deskripsi' WHERE id = $id"
     );
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


function register() {
    global $conn;

    $username = $_POST["username"];
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $cPassword = mysqli_real_escape_string($conn, $_POST["password2"]);

    // hindari user dengan nama sama
    $user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($user)) {
        echo "
        <script>
            alert('username dengan nama ini sudah terdaftar!');
        </script>
        ";

        return false;
    }  

    // confirmasi password
    if ($password !== $cPassword) {
        echo "
        <script>
            alert('konfirmasi password tidak sesuai!');
        </script>
        ";

        return false; 
    }

    // panjang password kurang dari 6 character
    if (strlen($password) < 6) {
        echo "
        <script>
            alert('panjang password tidak boleh kurang dari 6 character!');
        </script>
        ";

        return false; 
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
?>