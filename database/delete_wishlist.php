<?php 
require '../functions.php';
session_start();

$user_id = $_SESSION["user_id"];
$product_id = $_GET["id"];

// delete wishlist
$query = "DELETE FROM user_wishlists WHERE user_id = $user_id AND product_id = $product_id";
mysqli_query($conn, $query);

echo "<script>
        alert('Produk berhasil dihapus dari wishlist');
        document.location.href = '../wishlist.php';
    </script>";

?>