<?php
require '../functions.php';
session_start();

$user_id = $_SESSION["user_id"];
$order_id = $_GET["id"];


approvePayment();

function approvePayment() {
    global $conn;
    $order_id = $_GET["id"];

    $query = "UPDATE transactions SET payment_status = 1 WHERE id = $order_id";

    mysqli_query($conn, $query);

    echo "<script>
            alert('Pembayaran berhasil dikonfirmasi');
            document.location.href = '../admin/admin.php';
        </script>";
}
?>