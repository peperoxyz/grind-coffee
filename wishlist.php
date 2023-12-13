<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION["user_id"];
$user_data = query("SELECT * FROM users WHERE id = $user_id")[0];

$wishlists = query("SELECT * FROM user_wishlists WHERE user_id = $user_id");
// var_dump($wishlists);


?>

<div class="sectionprofil">
    <div class="leftbarmenu">
        <div class="namaprofil">
            <i class="fa-regular fa-circle-user" style="text-transform: capitalize"> <h5><?php echo $user_data["first_name"] . ' ' . $user_data['last_name']?></h5></i>
        </div>
        <div class="menuleftbar">
            <a href="profile.php">
                <div class="menu">
                    <i class="fa-regular fa-circle-user"><h5>Profil</h5></i>
                </div>
                </a>
                <!-- <div class="menu">
                    <i class="fa-solid fa-address-book"><h5>Daftar Alamat</h5></i>
                </div> -->
                <a href="orders.php">
                <div class="menu"> 
                    <i class="fa-solid fa-clipboard-list"><h5>Pesanan Saya</h5></i>

                </div>
                </a>
                <a href="wishlist.php">
                <div class="menu">
                    <i class="fa-solid fa-heart"><h5>Wishlist Produk</h5></i>
                </div>
                </a>
                 <hr />
        </div>
    </div>

    <div class="isiprofil">
        <div class="alamat">
          <i class="fa-solid fa-clipboard-list"></i>
          <h5>Wishlist Produk Saya</h5>
        </div>
        <hr class="garis" />
        <?php foreach ($wishlists as $wishlist) : 
$product = query("SELECT * FROM products WHERE id = ${wishlist['product_id']}")[0]; ?>
        <div class="boxpesanan">
          <div class="jarakiconshop">
            <div class="iconshop">
              <i class="fa-solid fa-shop"></i>
              <h3>Grind Coffee</h3>
            </div>
            
          </div>
          <div></div>
          <div class="garispesanan"></div>
          <div class="productpesanan">
            <div class="imageproductpesanan">
            <img src="assets/images/product_images/<?php echo $product["image"]?>" alt="" />
              <div class="textproductpesanan">
                <h3><?php echo $product["name"]?></h3>
                <h5>x1</h5>
              </div>
            </div>
            <div class="hargaitem">
              <h3 >Rp. <?php echo $product["price"]?></h3>
            </div>
          </div>
          <div class="garispesanan"></div>
          <div class="totalharga">
            <h3></h3>
            <a href="product_details.php?id=<?php echo $product['id']?>"><button class="button1">Lihat Detail</button></a>
            <a href="database/delete_wishlist.php?id=<?php echo $product['id'];?>" onclick="hapus_wishlist()"><button class="button2">Hapus dari Wishlist</button></a>
          </div>
        </div>
        <?php endforeach; ?>
    
      </div>

</div>
