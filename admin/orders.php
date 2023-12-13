<?php

require '../functions.php';
session_start();
if( isset($_SESSION["login"]) ) {
    // only admin can access this page
    if( $_SESSION["role"] != "admin" ) {
        header("Location: ../index.php");
        exit();
    }
}

$orders = query("SELECT * FROM transactions");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5e5ce;
        }

        #sidebar {
            background-color: #31452c;
            height: 100vh;
            /* width: 250px; */
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            color: white;
            padding-left: 20px;
            padding-right: 60px;
        }

        #sidebar a {
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        #sidebar a:hover {
            background-color: #c56e33;
        }

        #content {
            margin-left: 250px;
            padding: 20px;
        }

        .menu-heading {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #c56e33;
        }

        .menu-item {
            padding: 10px 0;
        }

        img {
            width: 100px;
            margin-bottom: 20px;
        }

        h1, p {
            color: #31452c;
        }

        table {
            width: 90%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #31452c;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #31452c;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .actions {
            text-align: center;
        }

        .edit {
            display: inline-block;
            padding: 6px 10px;
            margin: 2px;
            text-decoration: none;
            background-color: royalblue;
            color: white;
            border-radius: 5px;
        }
        
        .approve {
            display: inline-block;
            padding: 6px 10px;
            margin: 2px;
            text-decoration: none;
            background-color: green;
            color: white;
            border-radius: 5px;
        }
    </style>
    <title>Admin Page</title>
</head>
<body>
    <div id="sidebar">
        <div class="logo">
            <img
            src="../assets/images/logos/logo-white.png"
            alt=""
            class="gambarlogo"
          />
        </div>

        <div class="menu-heading">Main Menu</div>
        <a style="background-color: #c56e33;" href="../admin/orders.php">Orders</a>
        <a href="../admin/products.php">Products</a>
    </div>

    <div id="content">
        <h1>List Orders</h1>
        <p>Daftar seluruh pesanan produk minuman kopi, biji kopi, dan merch pada website Grind Coffee.</p>
        <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Total Biaya</th>
                <th>Status Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Metode Pengiriman</th>
                <th>Bukti Transfer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dummy Data -->
            <?php foreach( $orders as $order ) : ?>
            <tr >
                <td><?php echo $order["id"]; ?></td>
                <td><?php echo $order["user_id"]; ?></td>
                <td><?php echo $order["total_amount_payment"]; ?></td>
                <td><?php if ($order["payment_status"] == 0) {
                    echo "Belum Dibayar";
                } else {
                    echo "Sudah Dibayar";
                }; ?></td>
                <td><?php echo $order["payment_method"]; ?></td>
                <td><?php echo $order["shipping_method"]; ?></td>
                <?php $order_id = $order["id"]; ?>
                <?php $payment_proof = query("SELECT * FROM payment_proofs WHERE transaction_id = $order_id"); ?>
                <td> 
                <?php if ($payment_proof) {  ?>    
                <img src="../assets/images/payment_proofs/<?php echo $payment_proof[0]["file_name"];?>" alt="">
                <?php }?>
                <?php if (!$payment_proof) { ?>    
                COD - Tanpa Bukti Transfer
                <?php }?> 
                </td>
                <td class="actions">
                    <!-- <a href="#" class="edit">Lihat</a> -->
                    <?php if ($order['payment_status'] == 0) { ?>
                    <a href="../database/approve_payment.php?id=<?php echo $order_id?>" class="approve">Setujui Pembayaran</a>
                    <?php } ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
    </div>
</body>
</html>
