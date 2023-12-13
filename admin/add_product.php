<?php 
require '../functions.php';
session_start();

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $slogan = $_POST['slogan'];
    $stock = $_POST['stock'];

    // upload image
    $image = upload();

    if (!$image) {
        return false;
    }

    $query = "INSERT INTO products VALUES('', '$name', '$category_id', '$price', '$description', '$slogan', '$stock', '$image')";
    mysqli_query($conn, $query);

    echo "<script>
            alert('Produk berhasil ditambahkan');
            document.location.href = '../admin/products.php';
        </script>";
}

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

        form {
            width: 50%;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #31452c;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #c56e33;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #a44e27;
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
        <a  href="../admin/orders.php">Orders</a>
        <a href="../admin/products.php">Products</a>
    </div>

    <div id="content">
        <h1>Add New Product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="category">Category ID:</label>
            <select id="category" name="category_id" required>
                <option value="1">Minuman</option>
                <option value="2">Biji Kopi Pilihan</option>
                <option value="3">Merchandise</option>
            </select>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="slogan">Slogan:</label>
            <input type="text" id="slogan" name="slogan" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>
</body>
</html>
