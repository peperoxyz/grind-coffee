<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "grind_coffee_db");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function register($data) {
	global $conn;

	$firstname = strtolower(stripslashes($data["first_name"]));
	$lastname = strtolower(stripslashes($data["last_name"]));
	$email = strtolower(stripslashes($data["email"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$phone = strtolower(stripslashes($data["phone"]));
	$birth_date = strtolower(stripslashes($data["birth_date"]));
	$is_admin = strtolower(stripslashes($data["is_admin"]));
	$address = strtolower(stripslashes($data["address"]));

	// cek email sudah ada atau belum
	$checkEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");


	if( mysqli_fetch_assoc($checkEmail) ) {
		echo "<script>
				alert('email sudah terdaftar!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO users VALUES('', '$firstname', '$lastname', '$email', '$password', '$phone', '$birth_date', '$is_admin', NOW(), NOW())");

	// send alamat ke tabel user_addresses
	// get user id dari insert yang terakhir dilakukan sebelumnya
	$user_id = mysqli_insert_id($conn);
	mysqli_query($conn, "INSERT INTO user_addresses VALUES('', '$user_id',NULL,NULL,NULL,NULL,NULL,NULL, '$address', NOW(), NOW())");

	return mysqli_affected_rows($conn);
}

function login($data) {
	global $conn;

	$email = $data["email"];
	$password = $data["password"];

	// cek email
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

	if( mysqli_num_rows($result) === 1 ) {
		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;
			$_SESSION["user_id"] = $row["id"];
			$_SESSION["user_name"] = $row["first_name"];

			// cek role
			if ($row["is_admin"] == 1) {
				$_SESSION["role"] = "admin";
			} else {
				$_SESSION["role"] = "user";
			}
			
			echo "<script>
			alert('Anda Berhasil Login !');
			document.location=' index.php';
			</script>";
			exit;
		}
	}
}

function uploadPaymentProof(){
	global $conn;

	$payment_proof = $_FILES['payment_proof']['name'];
	$payment_proof_tmp = $_FILES['payment_proof']['tmp_name'];
	$payment_proof_size = $_FILES['payment_proof']['size'];
	$payment_proof_error = $_FILES['payment_proof']['error'];

	// cek apakah ada gambar yang diupload
	if( $payment_proof_error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $payment_proof);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $payment_proof_size > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$payment_proof_baru = uniqid();
	$payment_proof_baru .= '.';
	$payment_proof_baru .= $ekstensiGambar;

	move_uploaded_file($payment_proof_tmp, '../assets/images/payment_proofs/' . $payment_proof_baru);

	return $payment_proof_baru;
}

function upload(){
	global $conn;

	$gambar = $_FILES['image']['name'];
	$gambar_tmp = $_FILES['image']['tmp_name'];
	$gambar_size = $_FILES['image']['size'];
	$gambar_error = $_FILES['image']['error'];

	// cek apakah ada gambar yang diupload
	if( $gambar_error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			</script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $gambar);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			</script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $gambar_size > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			</script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$gambar_baru = uniqid();
	$gambar_baru .= '.';
	$gambar_baru .= $ekstensiGambar;

	move_uploaded_file($gambar_tmp, '../assets/images/product_images/' . $gambar_baru);

	return $gambar_baru;
}

function addWishlist($data, $product_id) {
	global $conn;

	$user_id = $_SESSION["user_id"];
	// $product_id = $data["product_id"];

	// cek apakah wishlist sudah ada atau belum
	$checkWishlist = mysqli_query($conn, "SELECT * FROM user_wishlists WHERE user_id = '$user_id' AND product_id = '$product_id'");

	if( mysqli_fetch_assoc($checkWishlist) ) {
		echo "<script>
				alert('Wishlist sudah ada!');
			</script>";
		return false;
	}

	// tambahkan wishlist baru ke database
	mysqli_query($conn, "INSERT INTO user_wishlists VALUES('', '$user_id', '$product_id', NOW())");

	return mysqli_affected_rows($conn);
}




?>