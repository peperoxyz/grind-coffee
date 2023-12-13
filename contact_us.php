<?php 
require 'templates/header.php';
?>

    <div class="sectioncontactus">
      <div class="contactus">
        <div class="header">
          <i class="fa-solid fa-phone"></i>
          <h1>Contact Us</h1>
        </div>
        <div class="garistengahs"></div>
        <div class="boxcontactus">
          <label for="">Your Name*</label>
          <input type="text" placeholder="Masukkan Nama Lengkap" />
        </div>
        <div class="boxcontactus">
          <label for="">Your Email*</label>
          <input type="text" placeholder="Masukkan Email" />
        </div>
        <div class="boxcontactus">
          <label for="">Massage*</label>
          <input class="pesan" type="text" placeholder="Masukkan Pesan" />
        </div>
        <button>Submit</button>
      </div>
    </div>

<?php 
require 'templates/footer.php';
?>
