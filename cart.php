<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION["user_id"];
$carts = query("SELECT * FROM user_carts WHERE user_id = $user_id");

?>

<div class="sectionkeranjang">
    <div class="sectionheader">
        <i class="fa-solid fa-cart-shopping"></i>
        <h1>Keranjang Belanja</h1>
    </div>
    <div class="sectionbox">
        <div class="roundedbox"><button>Semua</button></div>
        <div class="roundedbox1"><button>Belum Bayar</button></div>
        <div class="roundedbox"><button>Dikirim</button></div>
        <div class="roundedbox"><button>Selesai</button></div>
    </div>
    <form action="database/cart.php" method="post">
        <div class="karkir">
            <div class="bordersection">
                <div class="rectanglebox">
                    <div class="checklist">
                        <h2>Produk</h2>
                    </div>
                    <div class="headerkeranjang">
                        <div><h2>Harga Satuan</h2></div>
                        <div><h2>Kuantitas</h2></div>
                        <div><h2>Total Harga</h2></div>
                        <div><h2>Aksi</h2></div>
                    </div>
                </div>

                <!-- loop each products -->
            	<?php foreach( $carts as $row ) : 
                    $product_id = $row["product_id"];
                    $product = query("SELECT * FROM products WHERE id = $product_id")[0];
                    ; ?>
                       <div class="borderproduct">
                        <div class="productheader">
                            <i class="fa-solid fa-shop"></i>
                            <h3>Grind Coffee</h3>
                        </div>
                        <hr class="garis1" />
                        <form action="database/cart.php" method="post">
                            <div class="checkitem">
                                <input type="checkbox" name="selected_cart[]" value="<?php echo $row["id"]; ?>" id="cart_<?php echo $row["id"]; ?>" />
                                <label for="cart_<?php echo $row["id"]; ?>"></label>
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']?>">
                                <div>
                                    <div style="display:flex; overflow:wrap; width:350px">
                                        <img style="height: 150px; margin-top:25px; margin-right:10px" src="assets/images/product_images/<?php echo $product["image"]; ?>" alt="" />
                                        <div>
                                            <h5 style="font-weigh:bold; font-size:20px;"><?php echo $product["name"]; ?></h5>
                                            <?php if ($product['category_id'] == 1) { ?>
                                            <p>Size: <span><?php echo $row["size_level"]; ?></span></p>
                                            <p>Sugar: <span><?php echo $row["sugar_level"]; ?></span></p>
                                            <p>Ice: <span><?php echo $row["ice_level"]; ?></span></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>  
                                <div style="display:flex; margin-left:40px">
                                    <h5 class="hargasatuan">Rp. <?php echo number_format($product["price"], 2, '.', ','); ?></h5>
                                    <div class="nambahkeranjang">
                                        <h1><?php echo $row["quantity"]; ?></h1>
                                    </div>
                                    <?php $total_price =  $product["price"] * $row["quantity"]; ?>
                                    <h5 class="totalharga">Rp.<?php echo number_format($total_price, 2, '.', ',')?> </h5>
                                    <input type="text" name="cart_id" value="<?php echo $row["id"]; ?>" hidden id="">
                                    <button  style="background-color:#f4e6cd; border:0px" type="submit" name="delete_cart">
                                        <div class="icontrash">
                                            <i class="fa-solid fa-trash">  </i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        
                        <hr class="garis2" />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="ringkasan">
            <h1>Checkout Produk</h1>
            <button name="checkout_cart" type="submit">Beli</button>
        </div>
        </div>
    </form>
</div>