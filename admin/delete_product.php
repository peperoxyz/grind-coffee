<?php 
require '../functions.php';
session_start();

$product_id = $_GET["id"];


// delete wishlist
$query = "DELETE FROM products WHERE id = '$product_id'";
mysqli_query($conn, $query);

echo "<script>
        alert('Produk berhasil dihapus !');
        document.location.href = '../index.php';
    </script>";

?>