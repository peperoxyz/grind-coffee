<?php 
require '../functions.php';

session_start();

$address_id = $_POST['address_id'];
$user_id = $_SESSION['user_id'];

// update address by address_id and user_id
$query = "UPDATE user_addresses set address = '$_POST[address]' WHERE id = $address_id AND user_id = $user_id";
mysqli_query($conn, $query);

echo "<script>
        alert('Alamat berhasil diupdate');
        document.location.href = '../profile.php';
    </script>";




?>