<?php
require 'templates/header.php';
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit();
}

$user_id = $_SESSION["user_id"];
$user_data = query("SELECT * FROM users WHERE id = $user_id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $no_telp = $_POST['no_telp'];
    $birth_date = $_POST['birth_date'];
    // $alamat = $_POST['alamat'];

    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', phone = '$no_telp', birth_date = '$birth_date' WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Data berhasil diupdate')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    } else {
        echo "<script>alert('Data gagal diupdate')</script>";
        echo "<script>window.location.href='profile.php'</script>";
    }
}

?>

    <section class="content_profil">
        <div class="sectionprofil">
            <div class="leftbarmenu">
            <div class="namaprofil">
                <i class="fa-regular fa-circle-user" style="text-transform: capitalize"> <h5><?php echo $user_data[0]["first_name"] . ' ' . $user_data[0]['last_name']?></h5></i>
            </div>
            <div class="menuleftbar">
                <a href="profile.php">
                <div class="menu">
                    <i class="fa-regular fa-circle-user"><h5>Profil</h5></i>
                </div>
                </a>
                 <hr />
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
            </div>
        </div>

          <div class="isiprofil">
            <div class="myprofil">
              <h5>My profil</h5>
            </div>
            <hr />
            <div class="uploadimage">
              <div class="iconimage">
                <img src="assets/images/addimage.png" alt="" />
                <div class="iconimageupload">
                  <img src="assets/images/addphoto.png" alt="" />
                  <h5>Upload foto</h5>
                </div>
              </div>

              <div>
              <form action="" method="POST" >
              <div class="inputprofil">
                <div class="fullname">
                  <label>First Name</label>
                  <input name="first_name" value="<?php echo $user_data[0]["first_name"] ?>" type="text" />
                </div>
                <div class="fullname">
                  <label>Last Name</label>
                  <input name="last_name" value="<?php echo $user_data[0]["last_name"] ?>" type="text" />
                </div>
                <div class="fullname">
                  <label>Email</label>
                  <input readonly name="email" value="<?php echo $user_data[0]["email"] ?>" type="text" />
                </div>
                <div class="notelp">
                  <div class="fullname">
                    <label for="">No.Telp</label>
                    <input name="no_telp" value="<?php echo $user_data[0]["phone"] ?>" type="text" />
                  </div>
                  <div class="fullname">
                  <label>Birth Date</label>
                  <input name="birth_date" value="<?php echo $user_data[0]["birth_date"] ?>" type="date" />
                </div>
                </div>
                <button style="margin-top: 18px">Update Data</button>
              </div>
              </form>

              <form action="database/user.php" method="post" style=" margin-bottom:60px">
                <?php $user_addresses = query("SELECT * FROM user_addresses WHERE user_id = $user_id");
                foreach ($user_addresses as $user_address) : ?>
                <div style="margin-top: -10px">
                <input type="hidden" name="address_id" value="<?php echo $user_address['id']?>">
                    <div class="boxcontactus" style="width:90%;">
                    <label style="font-weight: 800">Masukkan Alamat</label>
                        <input type="hidden" name="address" value="<?php echo $user_address['address']?>">
                        <textarea name="address" style="padding:1rem" class="pesan" type="text" placeholder="Alamat" ><?php echo $user_address['address']?></textarea>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- edit alamat -->
                <div class="updatealamat" style="margin-top: 0px">
                    <button name="edit_address" type="submit" style="text-decoration: none; ">Update Alamat</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
    </section>


<?php
require 'templates/footer.php';
?>