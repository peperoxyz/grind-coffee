<?php 
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit();
}

$product_id = $_GET["id"];
$product = query("SELECT * FROM products WHERE id = $product_id")[0];



?>

<form action="database/cart.php" method="post">
    <div class="sectionproduct">
      <div class="productdetail">
        <input type="hidden" value="<?php echo $product["id"]?>" name="product_id">
        <div class="posisiproduct">
          <img src="assets/images/product_images/<?php echo $product["image"]?>" alt="" />
        </div>
        <div class="posisidetail">
          <h1 style="text-transform:capitalize"><?php echo $product['name'];?></h1>
          <div class="ratingproduct">
            <div class="ratingicon">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
            </div>
            <h5>4,5</h5>
            <h6>Tersisa <?php echo $product['stock'];?> buah</h6>
          </div>
          <div class="hargaproduct">
            <h3>RP. <?php echo number_format($product['price'], 2, '.', ',') ;?></h3>
          </div>
          <div class="buttonsimpan">
            <a style="text-decoration:none"><button name="add_wishlist" ><i class="fa-regular fa-heart"></i>Simpan</button></a>
          </div>
           <?php if ($product['category_id'] == 1) { ?>
            <div class="ukuranpilihan">
                <div class="size">
                    <h3>Size Level</h3>
                    <select style="background-color: #c56e33; border-radius:10px; padding:10px; border:none; color:white" name="size_level">
                        <option selected value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>
                </div>
                <div class="size">
                    <h3>Sugar Level</h3>
                    <select style="background-color: #c56e33; border-radius:10px; padding:10px; border:none; color:white" name="sugar_level">
                        <option selected value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="size">
                    <h3>Ice Level</h3>
                    <select style="background-color: #c56e33; border-radius:10px; padding:10px; border:none; color:white" name="ice_level">
                        <option selected value="light">Light</option>
                        <option value="normal">Normal</option>
                        <option value="extra">Extra</option>
                    </select>
                </div>
            </div>
        <?php } ?>
        <div class="ukuransize">
            <div>
              <div class="ukuransize" style="margin-top: 0px; gap:10px;">
                <button type="button" class="quantity-button" onclick="decrementQuantity()"><i class="fa-solid fa-minus"></i></button>
                <input style="height: 30px; padding-left:10px; width:36px" type="number" name="quantity" id="quantity" placeholder="0" value="1" min="1" />
                <button type="button" class="quantity-button" onclick="incrementQuantity()"><i class="fa-solid fa-plus"></i></button>
                <input type="hidden" name="produk_id" value="<?php echo $product['id']?>">
              </div>
            </div>
        <script>
            function incrementQuantity() {
                var quantityInput = document.getElementById('quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
            }
            function decrementQuantity() {
                var quantityInput = document.getElementById('quantity');
                var currentValue = parseInt(quantityInput.value);

                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            }
        </script>
            <div class="rectanglekeranjang">
              <button name="add_to_cart" type="submit">
                Masukkan Keranjang <i class="fa-solid fa-cart-shopping"></i>
              </button>
            </div>
            <div class="belisekarang">
              <button name="add_to_cart" type="submit">Beli Sekarang</button>
            </div>
          </div>
        </div>
      </div>
      <div class="sectiondeskripsi">
        <div class="deskripsiproduk">
          <h1>Deskripsi Produk</h1>
          <h5>
          <?php echo $product['description'];?>
          </h5>
        </div>
      </div>
    </div>
</form>
    <?php
    require 'templates/footer.php';
?>