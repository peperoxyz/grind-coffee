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

$products = query("SELECT * FROM products");
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
            width: 97%;
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
        
        .delete {
            display: inline-block;
            padding: 6px 10px;
            margin: 2px;
            text-decoration: none;
            background-color: red;
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
        <a href="../admin/orders.php">Orders</a>
        <a style="background-color: #c56e33;" href="../admin/products.php">Products</a>
    </div>

    <div id="content">
        <div style="display:flex; justify-content:space-between; align-items:center; padding-right:40px; ">
            <div>
                <h1>List Products</h1>
                <p>Daftar seluruh produk minuman kopi, biji kopi, dan merch pada website Grind Coffee.</p>
            </div>
            <div style="background-color: #c56e33; padding:16px; ">
                <a style=" text-decoration:none; underline:none; color:white" href="../admin/add_product.php">Tambah Produk</a>
            </div>
        </div>
        <table>
        <thead>
            <tr>
                <th>Produk ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dummy Data -->
            <?php foreach( $products as $product ) : ?>
            <tr >
                <td> <?php echo $product["id"]; ?> </td>
                <td> <?php echo $product["name"]; ?> </td>
                <td> <?php echo $product["price"]; ?> </td>
                <td> <?php echo $product["stock"]; ?> </td>
                <td> <?php echo $product["description"]; ?> </td>
                <td> <img src="../assets/images/product_images/<?php echo $product["image"]; ?>" alt=""> </td>
                <td class="actions">
                    <a href="edit_product.php?product_id=<?php echo $product['id']?>" class="edit">Edit</a>
                    <a href="delete_product.php?id=<?php echo $product['id']?>" class="delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
    </div>
</body>
</html>
