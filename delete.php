<?php 
include "functions.php";

$id = $_GET["id"];

if (deleteItem($id) > 0) {
    echo "
        <script>
            alert('buku berhasil dihapus!');
            document.location.href = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('buku gagal dihapus!');
        </script>
    ";
}
?>