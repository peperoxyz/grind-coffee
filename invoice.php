<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION["user_id"];
$user_data = query("SELECT * FROM users WHERE id = $user_id")[0];
$user_address = query("SELECT * FROM user_addresses WHERE user_id = $user_id");

$order_id = $_GET['order_id'];

$order = query("SELECT * FROM transactions WHERE id = $order_id");
$sub_total = 0;
$admin_fee = 5000;
$shipping_fee = 15000;
?>

<style>
    *{
        font-family: poppins;
    }
    .wrapper {
        padding:50px;
        margin: 90px auto;
        width: 70%;
        border: 1px solid black;
        border-radius: 16px;
    }
    .header {
       
        display:flex;
        justify-content: space-between;
        align-items: center;
    }
    .opening {
        display:flex;
        justify-content:space-between;
        /* gap:10rem; */
    }
    .opening {
        /* border-bottom: 2px black solid;
        padding-bottom: 30px; */
    }
    .opening .buyer {
        width:400px;
    }
    table {
        background: none;
        color:black;
        /* width:400px; */
    }

    tr:nth-child(even) {
    background: none; /* Warna latar belakang baris genap */
    }

    thead, td {
    padding: 5px;
    font-family: poppins;
    text-align: left;
    border-bottom: 0px solid #c56e33; /* Warna garis bawah */
    }

    .produk{
        margin: 30px 0;
        border-top: solid 2px black;
        border-bottom: solid 2px black;
        padding: 10px 0;
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
</style>

<div class="wrapper">
    <div class="header">
        <img height="130" src="assets/images/logos/logo-dark.png" alt="">
        <div>
            <h2>INVOICE ORDER</h2>
            <p>#GC | #Order ID - <?php echo $order_id ?></p>
        </div>
    </div>
    <div class="opening">
        <div class="seller">
            <h3>DI TERBITKAN ATAS NAMA</h3>
            <p>Penjual: GRIND COFFEE</p>
        </div>    
        <div class="buyer">
            <h3>UNTUK</h3>
            <table>
            <tr>
                <td>Pembeli</td>
                <td>:</td>
                <td style="text-transform: capitalize"><?php echo $user_data['first_name'].' '.$user_data['last_name']?></td>
            </tr>
            <tr>
                <td>Tanggal Pembelian</td>
                <td>:</td>
                <td><?php echo $order[0]['created_at'] ?></td>
            </tr>
            <tr>
                <td>Alamat Pengiriman</td>
                <td>:</td>
                <td><?php echo $user_address[0]['address']?></td>
            </tr>
            </table>
        </div>    
    </div>
    <div class="produk">
        <div class="opsi-dtl">
            <div class="gambar" style="display:flex;justify-content:space-between; ">
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
            <?php
                $order_details = query("SELECT * FROM transaction_details WHERE transaction_id = $order_id"); 
                
                $product_id = $order_details[0]["product_id"];
                $product = query("SELECT * FROM products WHERE id = $product_id");
                ?>
                <?php foreach ($order_details as $order_detail) : ?>
                <?php
                $product = query("SELECT * FROM products WHERE id = {$order_detail['product_id']}")[0];
                ?>
                <div id="checkout-item" style="display:flex; justify-content:space-between; gap:2rem">
                    <div style="display:flex; overflow:wrap; width:320px">
                        <div>
                            <h5 style=" font-size:20px; margin-bottom:0px"><?php echo $product["name"]; ?></h5>
                        </div>
                    </div>
                    <div class="header" style="display: flex; gap:8rem;">
                        <div><h5>Rp. <?php echo $product['price']?></h5></div>
                        <div><h5><?php echo $order_detail['quantity']?></h5></div>
                        <div><h5>Rp. <?php echo $order_detail['amount']?></h5></div>
                    </div>
                </div>
                <?php $sub_total += $order_detail['amount'];  ?>
            <?php endforeach; ?>
            <?php ?>
        </div>
    </div>
    <?php $order = query("SELECT * FROM transactions WHERE id = $order_id")[0]; ?>
   
    <div style="display:flex; justify-content:end">
        <div  class="perhitungan">
            <table style="width: 500px;">
                <tr>
                    <td style="text-align: right;">Sub Total Produk :</td>
                    <td style="text-align: right;">Rp. <?php echo number_format($sub_total, 2, '.', ',') ?> </td>
                </tr>
                <tr>
                    <td style="text-align: right;">Biaya Ongkos Kirim :</td>
                    <td style="text-align: right;">Rp.<?php echo number_format($shipping_fee, 2, '.', ',') ?> </td>
                </tr>
                <tr>
                    <td style="text-align: right;">Biaya Layanan :</td>
                    <td style="text-align: right;">Rp.<?php echo number_format($admin_fee, 2, '.', ',') ?> </td>
                </tr>
                <tr style="font-weight: bold; font-size: 20px">
                    <td style="text-align: right;"> <h3>Grand Total :</td>
                    <?php $total_amount = $sub_total+$shipping_fee+$admin_fee; ?>
                    <td style="text-align: right;"> <h3> Rp.  <?php echo number_format($order['total_amount_payment'], 2, '.', ',')?> </h3> </td>
                </tr>
            </table>
        </div>
    </div>

    
</div>

<?php require 'templates/footer.php'; ?>