<?php 

require '../functions.php';
session_start();

$user_id = $_SESSION["user_id"];
$product_id = $_POST["product_id"];
$product = query("SELECT * FROM products WHERE id = $product_id")[0];

if (isset($_POST["add_to_cart"])) {

    $quantity = $_POST["quantity"];
    $price = $product['price'] * $quantity;

    if ($product['category_id'] == 1) {
        
        $size_level = $_POST["size_level"];
        $sugar_level = $_POST["sugar_level"];
        $ice_level = $_POST["ice_level"];
        
        $query = "INSERT INTO user_carts VALUES('', '$user_id', '$product_id', '$quantity', '$size_level', '$sugar_level', '$ice_level', NOW())";
        mysqli_query($conn, $query);

        echo "<script>
                alert('Produk berhasil ditambahkan ke keranjang');
                document.location.href = '../cart.php';
            </script>";

    } 
    else {
        
        $query = "INSERT INTO user_carts VALUES('', '$user_id', '$product_id', '$quantity',NULL, NULL, NULL, NOW())";
        mysqli_query($conn, $query);

        echo "<script>
            alert('Produk berhasil ditambahkan ke keranjang');
            document.location.href = '../cart.php';
        </script>";

    }
}

if (isset($_POST["delete_cart"])) {

    $cart_id = $_POST["cart_id"];
    $query = "DELETE FROM user_carts WHERE id = $cart_id";
    mysqli_query($conn, $query);
    

    header("Location: ../cart.php");
    exit();
}

// checkout to transaction
if (isset($_POST['checkout_cart'])) {
    if (isset($_POST['selected_cart']) && is_array($_POST['selected_cart'])){
        $selectedCartIds = $_POST['selected_cart'];

        $cartIdString = http_build_query(['cartIds' => $selectedCartIds]);
        $url = '../checkout.php?' . $cartIdString;
        header("Location: $url");
    } else {
        // alert and redirect to cart page
        echo "<script>
                alert('Pilih produk yang ingin dibeli');
                document.location.href = '../cart.php';
            </script>";
    }
}

if (isset($_POST['add_wishlist'])) {
 
    $user_id = $_SESSION["user_id"];
	$product_id = $_POST["product_id"];

	// cek apakah wishlist sudah ada atau belum
	$checkWishlist = mysqli_query($conn, "SELECT * FROM user_wishlists WHERE user_id = '$user_id' AND product_id = '$product_id'");

	if( mysqli_fetch_assoc($checkWishlist) ) {
		echo "<script>
				alert('Wishlist sudah ada!');
                 document.location.href = '../wishlist.php';
			</script>";
		return false;
	}

	// tambahkan wishlist baru ke database
	mysqli_query($conn, "INSERT INTO user_wishlists VALUES('', '$user_id', '$product_id', NOW())");

    // alert
    echo "<script>
            alert('Produk berhasil ditambahkan ke wishlist');
            document.location.href = '../wishlist.php';
        </script>";
}


?>