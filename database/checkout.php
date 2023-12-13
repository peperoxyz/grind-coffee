<?php 

require '../functions.php';
session_start();

$user_id = $_SESSION["user_id"];

if (isset($_POST["checkout"])){
    // check address
    $user_address = query("SELECT * FROM user_addresses WHERE user_id = $user_id")[0];
    if ($user_address == null) {
        echo "<script>
                alert('Alamat belum diisi');
                document.location.href = '../profil.php';
            </script>";
    } else {
        insertTransaction();
    }
}

function insertTransaction() {
    global $conn;

    if (true) {
        $user_id = $_SESSION["user_id"];
        $address_id = $_POST['address_id'];

        if ($_POST['payment_method'] == 'cod') {
            $payment_status = 1;
        } else {
            $payment_status = 0;
        }

        $total_amount_payment = $_POST['total_amount'];
        
        $payment_method = $_POST['payment_method'];
        $shipping_method = $_POST['shipping_method'];

        $query = "INSERT INTO transactions VALUES('', '$user_id', '$address_id', '$payment_status', '$total_amount_payment', NOW(), '$payment_method', '$shipping_method', NOW(), NOW())";

        mysqli_query($conn, $query);

        $transaction_id = mysqli_insert_id($conn);

        // convert $_POST['productIds]  to array
        $productIds = explode(',', $_POST['productIds']);
        $cartIds = explode(',', $_POST['cartIds']);

        foreach ($cartIds as $cartId) {
            $cart = query("SELECT * FROM user_carts WHERE id = $cartId")[0];
            $product = query("SELECT * FROM products WHERE id = $cart[product_id]")[0];
            
            $product_id = $cart['product_id'];

            $size_level = $cart['size_level'];
            $sugar_level = $cart['sugar_level'];
            $ice_level = $cart['ice_level'];

            $price = $product['price'];
            $quantity = $cart['quantity'];
            $amount = $product['price'] * $cart['quantity'];
            
            $query = "INSERT INTO transaction_details VALUES('', '$transaction_id', '$product_id', '$size_level', '$sugar_level', '$ice_level', '$price', '$quantity', '$amount', NOW(), NOW())";
            mysqli_query($conn, $query);

            // update product stock
            $stock = $product['stock'] - $quantity;
            
            $query = "UPDATE products SET stock = $stock WHERE id = $product_id";
            mysqli_query($conn, $query);
        }
        
        if ($_POST['payment_method'] == 'transfer' && $transaction_id) {
            
            $payment_proof = uploadPaymentProof();

            $file_name = $payment_proof;

            $query = "INSERT INTO payment_proofs VALUES('', '$transaction_id', '$payment_proof', NOW())";
            mysqli_query($conn, $query);
        }

         echo "<script>
                alert('Anda Berhasil Checkout');
                document.location.href = '../index.php';
            </script>";


    } else {
       
    }
}



?>