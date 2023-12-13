<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION["user_id"];
$user_data = query("SELECT * FROM users WHERE id = $user_id")[0];
$user_address = query("SELECT * FROM user_addresses WHERE user_id = $user_id")[0];

$cartIds = $_GET['cartIds'];
foreach ($cartIds as $cartId) {
    $cart = query("SELECT * FROM user_carts WHERE id = $cartId");
}

$sub_total = 0;
$admin_fee = 5000;
$shipping_fee = 15000;

$productIds = array();
$rekening = "999 021 0990 9992 78";

$showRekening = false;


?>
<script>
function copyText() {
  var textToCopy = "999 021 0990 9992 78";
  var dummyElement = document.createElement("textarea");
  document.body.appendChild(dummyElement);
  dummyElement.value = textToCopy;
  dummyElement.select();
  document.execCommand("copy");
  document.body.removeChild(dummyElement);
  alert("No.Rekening Tersailin. Silakan lakukan pembayaran");
   event.preventDefault();
}
</script>

<style>
    .cowrap{
        /* width: 1200px;
        height: auto; */
        display: flex;
        flex-direction: column;
        font-family: 'poppins', sans-serif;
        border: black 1px solid;
        
        padding: 70px;
    }
    .cotext{
        display: flex;
        flex-direction: row;
        /* border: black 1px solid; */

    }
    .dipesan{
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        border: 1px solid #000;
    }
    .dipesandesc{
        display: flex;
        flex-direction: row;
        margin-left: 10px;
        gap:4px;
        align-items: center;
    }

    .dipesandesc p {
        margin: 0px;
        margin-top:12px;
    }

    .border{
        /* width: 1000px; */
        /* border:black 1px solid; */
    }
    .detailpelanggan{
        margin-bottom: 20px;
        margin-right: 20px;
        display: flex;
        flex-direction: row;
        /* gap: 50px; */
        border-bottom: 1px solid black;
        margin-left: 30px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .border img{
        width: 100%;
        height: 5px;
    }
    .notelp p{
        font-weight: 600;
        font-size: 17px;
    }
    .alamat p{
        font-weight: 400;
    }
    .opsi{
        border: 1px black solid;
        border-radius: 12px;
        margin-top: 40px;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); 
    }
    .picture{
        gap:10px;
        display: flex;
        align-items: center;
    }
    .opsi-dtl{
        margin:25px;
        display: flex;
        flex-direction: column;
        margin-left: 50px;
        margin-right: 50px;
    }
    .gambar{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .gambar .header {
        display: flex;
        gap:6rem;
    }
    .header h5 {
        font-size:19px;
    }
    .metode-pembayaran {
        padding:30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    
    }
    .pilihan {
        display: flex;
        gap:10px;
    }

    .pilihan .box {
        font-size: 20px;
        font-weight: bold;
        shadow: 1px;
        padding:5px;
        padding-right: 20px;
        padding-left: 20px;
        border: solid 1px black;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); 
    }

    .box:hover{
        background-color:#C56E33;
        cursor:pointer;
        color:white;
    }

    .total {
        padding:20px;
    }
    

    .total .perhitungan {
        padding:15px;
        border-bottom: 1px solid black;
        margin-bottom:10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: end;
    }

    .total .button-order {
     display:flex;
     justify-content: end;
    }

    button {
        background-color: #C56E33;
        color: white;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
    }

    table {
        background: none;
        color:black;
        width:400px;
    }

    tr:nth-child(even) {
    background: none; /* Warna latar belakang baris genap */
    }

    thead, td {
    padding: 5px;
    font-family: poppins;
    text-align: right;
    border-bottom: 0px solid #c56e33; /* Warna garis bawah */
    }

    .container {
    display: flex;
    width:100%;
    justify-content: center;
    gap: 50px;
    }
    .secbawah{
    /* padding-top: 40px; */
    display: flex;
    flex-direction: row;
    justify-content: center;
    }
    .secbawah .left{
    width: 100px;
    }
    .buttonsalin{
    /* background: none; */
    border: none;
    /* color: #000; */
    cursor: pointer;
    font-family: 'poppins';
    font-size: 24px;
    font-weight: 700;
    }
    .upload-input {
    margin-top: 20px;
    margin-left: 20px;
    width: 400px;
    border: 1px solid #000;
    border-radius: 10px;
    padding: 20px;
    font-size: 18px;
    font-weight: 700;
    }

</style>

<div class="cowrap">
<form action="database/checkout.php" method="post" enctype="multipart/form-data">
    <div class="cotext" style="padding-left:20px;">
        <img src="assets/images/cart.png" alt="" style="width:25px;height:25px;margin-top:20px;"><h3>Checkout</h3>
    </div>
    <div class="dipesan">
        <div class="border"><img src="assets/images/strip.png" alt=""></div>
            <div class="dipesandesc"><img src="assets/images/gps.png" alt="" style="width:18px;height:25px;margin-top:10px;">
                <p style="font-weight: 700;">Alamat Penerima</p>
            </div>
        <div class="detailpelanggan">
            <div style="text-transform: capitalize" class="notelp">
                <p ><?php echo $user_data['first_name'].' '.$user_data['last_name']  ?><br><?php echo $user_data['phone']?></p>
            </div>
            <?php if ($user_address) {?>
            <!-- hidden input -->
            <input type="hidden" name="address_id" value="<?php echo $user_address['id']?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id?>">
            <div class="alamat" style="width: 80%; height: auto; text-decoration:capitalize">
                <p><?php echo $user_address['address']?>, <br> Kecamatan <?php echo $user_address['district']?>, Kota <?php echo $user_address['city']?>, Provinsi <?php echo $user_address['province']?> <br> <?php echo $user_address['zip_code']?> </p>
            </div>
            <?php }?>
            <?php if (!$user_address) {?>
            <div class="alamat" style="width: 80%; height: auto; text-decoration:capitalize">
                <p>Belum ada alamat. Mohon tambah alamat baru. </p>
            </div>
            <?php }?>
        </div>
    </div>
    <div class="opsi">
        <div class="dipesandesc"><p style="font-weight: 400;margin-left:12px;">Produk Dipesan</p></div>
        <div class="opsi-dtl">
            <div class="gambar" style="display:flex;justify-content:space-between; border-bottom: 1px solid black">
                <div class="picture" style="display: flex; flex-direction:row;">
                    <i style="font-size:25px" class="fa-solid fa-shop"></i><h4 style="margin:0px">Grind Coffee</h4>
                </div>
                <div class="header" style="font-weight: bold;">
                    <div class="harga"><p>Harga Satuan</p></div>
                    <div class="jumlah"><p>Jumlah</p></div>
                    <div class="subttl"><p>Sub Total Produk</p></div>
                </div>
            </div>
            <!-- looping -->
            <?php foreach ($cartIds as $cartId) {  ?>
            <?php $item_checkout = query("SELECT * FROM user_carts WHERE id = $cartId")[0]; ?>
            <?php $data_produk = query("SELECT * FROM products WHERE id = $item_checkout[product_id]")[0]; $productIds[] = $data_produk['id']; ?>
            
            <div id="checkout-item" style="display:flex; justify-content:space-between; gap:2rem">
                <div style="display:flex; overflow:wrap; width:320px">
                    <img style="height: 150px; margin-top:25px; margin-right:10px" src="assets/images/product_images/<?php echo $data_produk['image']?>" alt="" />
                    <div>
                    <h5 style=" font-size:20px; margin-bottom:0px"><?php echo $data_produk["name"]; ?></h5>
                    </div>
                </div>
                <div class="header" style="display: flex; gap:8rem;">
                    <div><h5>Rp. <?php echo $data_produk['price']?></h5></div>
                    <div><h5><?php echo $item_checkout['quantity']?></h5></div>
                    <?php $amount = $data_produk['price'] * $item_checkout['quantity']; ?>
                    <div><h5>Rp. <?php echo $amount?></h5></div>
                </div>
            </div>
            <?php $sub_total += $amount;  ?>
            <?php }?>
        </div>
    </div>
    
    <div class="metode-pembayaran opsi">
        <div>
        <div>
            <h3>Metode Pembayaran</h3>
            <select name="payment_method" id="paymentMethod" onchange="handleSelectionChange()">
                <option value="cod">COD</option>
                <option selected value="transfer">Transfer Bank</option>
            </select>
            <script>
                function handleSelectionChange() {
                    var selectElement = document.getElementById("paymentMethod");
                    var selectedValue = selectElement.value;

                    if (selectedValue == "transfer") {
                        document.getElementById("showRekening").style.display = "block";
                    } else {
                        document.getElementById("showRekening").style.display = "none";
                    }
                }
            </script>
          
        </div>

        </div>
        <div>
            <h3>Metode Pengiriman</h3>
            <select name="shipping_method" id="shippingMethod">
                <option value="gojek">GoJek</option>
                <option value="jne">JNE</option>
                <option value="jnt">JNT</option>
            </select>
        </div>
    </div>

    <div id="showRekening" class="metode-pembayaran opsi transfer bank">
        <div class="container">
            <div class="secbawah">
                <div class="left"><img src="assets/images/BNI.png" alt=""></div>
                <div class="right">
                    <h2>Bank BNI</h2>
                    <b> <span>No.Rekening:</span> </b>
                    <div class="rekening" style="display:flex; flex-direction: row;"><h2 style="color:#C56E33; font-weight:700;"><?php echo $rekening?></h2><button class="buttonsalin" style="margin-left:40px;" onclick="copyText()">SALIN</button></div>
                    <h2 style="font-size:18px; font-weight:700;">Proses verifikasi kurang dari 10 menit setelah pembayaran berhasil</h2>
                    <p style="width:600px;">Bayar pesanan ke Nomor Rekening di atas.</p>
                </div>
            </div>
            <div class="seckanan">
                <!-- upload bukti tf -->
                <div class="upload">
                    <h2>Upload Bukti Transfer</h2>
                    <input class="upload-input" type="file" name="payment_proof" id="paymentProof">
                </div>
            </div>
        </div>
    </div>

    
    <div class="total opsi">
        <div class="perhitungan">
            <table>
                <tr>
                    <td>Sub Total Produk :</td>
                    <td> Rp <?php echo number_format($sub_total, 2, '.', ',') ?> </td>
                </tr>
                <tr>
                    <td>Biaya Ongkos Kirim :</td>
                    <td>Rp.<?php echo number_format($shipping_fee, 2, '.', ',') ?> </td>
                </tr>
                <tr>
                    <td>Biaya Layanan :</td>
                    <td>Rp.<?php echo number_format($admin_fee, 2, '.', ',') ?> </td>
                </tr>
                <tr style="font-weight: bold; font-size: 20px">
                    <td > <p>Grand Total :</td>
                    <?php $total_amount = $sub_total+$shipping_fee+$admin_fee; ?>
                    <td>Rp. <?php echo number_format($total_amount, 2, '.', ',')?> </td>
                </tr>
            </table>
        </div>
        <!-- hidden input -->
        <input type="hidden" name="productIds" value="<?php echo implode(',', $productIds)?>">
        <input type="hidden" name="cartIds" value="<?php echo implode(',', $cartIds)?>">
        <input type="hidden" name="total_amount" value="<?php echo $total_amount?>">
        <div class="button-order">
            <!-- <button style="margin-right: 10px" ><a style="text-decoration:none; color:white;">Batalkan Checkout</a></button>  -->
            <button style="background-color: #31452c" type="submit" name="checkout">Checkout Keranjang</button>
        </div>
    </div>
    </form>
</div>


<?php 
include 'templates/footer.php';
?>