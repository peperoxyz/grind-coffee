<?php
session_start();
// require 'functions.php';
// var_dump($_SESSION['login'], $_SESSION['user_id'], $_SESSION['role']);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Rufina&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/aa225e1aa6.js"
      crossorigin="anonymous"
    ></script>

    <title>Grind Coffe</title>
  </head>
  <body>
    <nav>
      <div class="posisilogo">
        <a href="index.php"
          ><img
            src="assets/images/logos/logo-white.png"
            alt=""
            class="gambarlogo"
          />
        </a>
      </div>
      <div class="textheader">
        <a href="about_us.php"><h3>About Us</h3></a>
        <a href="coffee_drinks.php"><h3>Menu</h3></a>
        <a href="contact_us.php"><h3>Kontak</h3></a>
        <a href="profile.php"><h3>Profil</h3></a>
        <?php if (($_SESSION["login"]) && ($_SESSION["role"])=="admin") {?>
        <a href="admin/orders.php"><h3>TokoKu</h3></a>
        <?php }?>
        <a href="wishlist.php"><i class="fa-solid fa-heart" style="color: white"></i></a>
        <a href="cart.php"> <i class="fa-solid fa-cart-shopping" style="color: white"></i> </a>
        <?php if (!$_SESSION["login"]) {?>
        <a id="btnLogin" href="login.php"> <h3>Login</h3> </a>
        <?php }?>
        <?php if ($_SESSION["login"]) {?>
        <a style="text-transform: capitalize" id="btnLogin" href="login.php"> <h3><?php echo $_SESSION["user_name"]?></h3> </a>
        <?php }?>
        <a> <h3> <span>|</span> </h3></a>
        <a href="logout.php"> <h3>Logout</h3> </a>
      </div>
    </nav>



