<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

?>

    <div class="section">
      <div class="textsection">
        <h2 class="textitem-1">Grind Coffe</h2>
        <h1 class="textitem-2">
          Kopi Dengan <br />
          Karakter
        </h1>
        <h5 class="textitem-3">
          Kopi adalah petualangan rasa, mengisi tiap detik dengan karakter
          <br />
          kuat yang memikat. Dengan kisah hidup dalam setiap tegukan, dengan
          karakteristik yang mendalam dan memikat. Bagikan keindahan karakter
          khas kopi yang Anda miliki. Bagikan keindahan karakter khas kopi yang
          anda miliki
        </h5>
      </div>

      <div class="gambarrounded">
        <img src="assets/images/round_latte.jpg" alt="" />
      </div>
    </div>

    <div class="banner">
      <img src="assets/images/banner-1.jpg" alt="" />
    </div>

    <div class="sectionitem">
      <div class="text1">PENASARAN DENGAN GRIND COFFEE?</div>
      <div class="text2">
        <h1>Dapatkan Milikmu Sekarang!</h1>
      </div>
      <br />
      <br />
      <div class="text3" style="margin-top:40px">
        <div class="product1">
          <div class="productbg">
            <img src="assets/images/merch.png" alt="" />
          </div>
          <h1>KOPI DENGAN KARAKTER</h1>
        </div>
        <div class="product2">
          <div class="productbg">
            <img src="assets/images/biji_kopi.png" alt="" />
          </div>
          <h1>BIJI KOPI PILIHAN</h1>
        </div>
        <div class="product3">
          <div class="productbg">
            <img src="assets/images/drinks.png" alt="" />
          </div>
          <h1>OFFICIAL MERCHANDISE</h1>
        </div>
      </div>
    </div>

    <div>
      <div class="sectionseller">
        <div class="boxtext">
          <h1>BEST SELLER</h1>
          <h5>
            Kopi yang paling disukai pelanggan kami, selalu ada secangkir baru
            yang layak untuk di coba
          </h5>
        </div>

        <div class="boxproduct">
          <h1>Matcha Latte</h1>
          <div class="bgtextseller">
            <img
              src="assets/images/matcha_index.jpg"
              alt=""
            />
            <h5>
              Minuman yang menawarkan cita rasa unik dan khas. Dipenuhi dengan
              sentuhan manis, ringan, dan segar yang berasal dari bubuk matcha.
            </h5>
          </div>
        </div>
      </div>

      <div class="sectionseller2">
        <div class="boxproduct2">
          <h1>Caffe Latte</h1>
          <div class="bgtextseller2">
            <img
              src="assets/images/caffelatte.jpg"
              alt=""
            />
            <h5>
              Minuman kopi yang memiliki cirikhas lembut dan berimbang. Ciri
              utama dari caffe latte adalah perpaduan sempurna antara espresso
              dan susu.
            </h5>
          </div>
        </div>
      </div>

      <div class="sectionseller">
        <div class="boxtext">
          <div class="boxmenu">
            <a>Semua Menu </a>
          </div>
        </div>

        <div class="boxproduct3">
          <h1>Matcha Latte</h1>
          <div class="bgtextseller">
            <img
              src="assets/images/matcha_index.jpg"
              alt=""
            />
            <h5>
              Minuman yang menawarkan cita rasa unik dan khas. Dipenuhi dengan
              sentuhan manis, ringan, dan segar yang berasal dari bubuk matcha.
            </h5>
          </div>
        </div>
      </div>
    </div>

    <div class="bgsubscribe">
      <div class="text1">
        <h1>LET’S GET CLOSER TO GRIND COFFEE!</h1>
        <h5>
          Dapatkan informasi terbaru & hal menyenangkan lainnya dengan
          berlangganan buletin kami
        </h5>
      </div>
      <div class="inputsubscribe">
        <input
          type="text"
          class="inputemail"
          placeholder="*Masukkan Email anda disini!"
        />
        <button class="btnsubscribe">Subscribe</button>
        <h5>
          Dengan mengisi formulir ini Anda akan sesekali menerima berita menarik
          tentang kami.
        </h5>
      </div>
    </div>

<?php
require 'templates/footer.php';
?>
