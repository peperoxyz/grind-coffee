<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION["user_id"];
$user_data = query("SELECT * FROM users WHERE id = $user_id")[0];

$orders = query("SELECT * FROM transactions WHERE user_id = $user_id");


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
                <hr />
                </div>
                </a>
                <a href="wishlist.php">
                <div class="menu">
                    <i class="fa-solid fa-heart"><h5>Wishlist Produk</h5></i>
                </div>
                </a>
        </div>
    </div>
    <div class="isiprofil">
    <div class="alamat">
        <i class="fa-solid fa-clipboard-list"></i>
        <h5>Pesanan Saya</h5>
    </div>
    <hr class="garis" />
    <div class="sectionbox">
        <div class="roundedbox"><button>Semua</button></div>
        <div class="roundedbox2"><button>Menunggu Pengiriman</button></div>
        <div class="roundedbox"><button>Dikemas</button></div>
        <div class="roundedbox"><button>Dikirim</button></div>
        <div class="roundedbox"><button>Selesai</button></div>
    </div>

    <!-- Add code to display orders based on their status -->
    <?php foreach ($orders as $order)  {  ?>
           <div class="boxpesanan">
                <div style="display: flex; justify-content: space-between;" class="iconshop">
                    <div style="display:flex; align-items:center; gap: 5px">
                    <i class="fa-solid fa-shop"></i>
                    <h3>Grind Coffee</h3>
                    </div>
                    <div >
                        <a href="invoice.php?order_id=<?php echo $order['id']?>"><button class="button1" style="color:white; font-size:15px; background-color:#c56e33; padding:10px; border:none; cursor:pointer; border-radius:7px">Lihat Invoice</button></a>
                    </div>
                </div>
                <div></div>
                <div class="garispesanan"></div>
                <!-- display products -->
                <?php $order_id = $order["id"];
                $order_details = query("SELECT * FROM transaction_details WHERE transaction_id = $order_id");
                $product_id = $order_details[0]["product_id"];
                $product = query("SELECT * FROM products WHERE id = $product_id");
                ?>
               <?php foreach ($order_details as $order_detail) : ?>
                <?php $product = query("SELECT * FROM products WHERE id = {$order_detail['product_id']}")[0]; ?>
                <div class="imageproductpesanan">
                    <img style="width:200px" src="assets/images/product_images/<?php echo $product['image']; ?>" alt="" />
                    <div class="textproductpesanan">
                        <h3><?php echo $product['name']; ?></h3>
                        <h5>x<?php echo $order_detail['quantity']; ?></h5>
                        <!-- varian -->
                        <?php if ($product['category_id'] == 1) { ?>
                           <b> Size: </b>    <span><?php echo $order_detail["size_level"]; ?></span> |
                           <b> Sugar: </b> <span><?php echo $order_detail["sugar_level"]; ?></span> |
                           <b> Ice: </b> <span><?php echo $order_detail["ice_level"]; ?></span>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>

                <div style="display:flex; align-items: center; justify-content:space-between; font-size:15px" class="hargaitem">
                    <h2>TOTAL : </h2>
                    <h3>Rp. <?php echo $order['total_amount_payment']; ?></h3>
                </div>
                
            </div>
    <!-- sini -->
    <?php } ?>
    <!-- End of orders loop -->
    </div>
</div>

