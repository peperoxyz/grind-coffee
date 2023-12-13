<?php 
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$product_drinks = query("SELECT * FROM products WHERE category_id = 1");
// var_dump($product_drinks);

?>

    <div class="posisibannertengah">
      <div class="bannertengah">
        <img src="assets/images/banner-2.png" alt="" />
      </div>
    </div>

    <div class="pilihankategori">
      <div class="product1">
        <a href="coffee_drinks.php">
          <div class="productbg">
            <img src="assets/images/drinks.png" alt="" />
          </div>
        </a>
        <h1>KOPI</h1>
        <div class="rectanglemenu"></div>
        <div class="triangledown"></div>
      </div>
      <div class="product1">
        <a href="coffee_beans.php">
          <div class="productbg">
            <img src="assets/images/biji_kopi.png" alt="" />
          </div>
        </a>
        <h1>BIJI KOPI</h1>
        <div class="rectanglemenu1"></div>
        <div class="triangledown1"></div>
      </div>
      <div class="product1">
        <a href="coffee_merch.php">
          <div class="productbg">
            <img src="assets/images/merch.png" alt="" />
          </div>
        </a>
        <h1>MERCH</h1>
        <div class="rectanglemenu1"></div>
        <div class="triangledown1"></div>
      </div>
    </div>

    <!-- load from db -->
    <div class="pilihanitem">
      <h5>PILIH RASA ANDA</h5>
      <div class="itemproducts">

        <?php $i = 1; ?>
        <?php foreach( $product_drinks as $data ) : ?>
        <div class="box">
          <div style="overflow:hidden">
            <img  src="assets/images/product_images/<?php echo $data["image"]?>" alt="" />
          </div>
          <h1><?php echo $data['name'];?></h1>
          <h5><?php echo $data['slogan'];?></h5>
          <div style="display:flex; justify-content:space-between; margin:10px; align-items:center; gap:50px" class="price_qty">
             <div class="stock price" style="text-align: center; ">Rp <?php echo number_format($data['price'],0, '.', ',') ?></div>
             <div class="stock">Tersisa <?php echo $data['stock'];?> buah</div>
          </div>
          <div class="posisirating">
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <div class="btnbeli">
              <a href='product_details.php?id=<?php echo $data['id']?>'>
              <button class="btnbelis"><h3>Lihat Produk</h3></button></a>
              
            </div>
          </div>
        </div>

        <?php $i++; ?>
    	<?php endforeach; ?>
      </div>
      <div class="posisiselanjutnya">
        <!-- <button>Selanjutnya </button> -->
      </div>
    </div>

<?php
require 'templates/footer.php';

?>