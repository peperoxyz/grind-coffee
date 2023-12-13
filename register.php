<?php
require 'functions.php';

if (isset($_POST["register"])) {
  if (register($_POST) > 0) {
    echo "<script>
            alert('Berhasil register akun. Silakan login !');
            document.location.href = 'login.php';
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}

$role = $_GET["role"];
if ($role == "admin") {
  $is_admin = 1;
} else {
  $is_admin = 0;
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Rufina&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/aa225e1aa6.js"
      crossorigin="anonymous"
    ></script>
    <title>Grind Coffe</title>
  </head>
  <body>
    <form
      action=""
      method="POST"
    >
      <div class="viewbg">
        <div class="boxregister">
          <img
            src="assets/images/logos/logo-transparent.png"
            alt=""
          />
          <h1>Personal Information</h1>
          <input
            type="hidden"
            name="is_admin"
            value="<?php echo $is_admin?>"
            placeholder="*First name"
            style="text-align: center"
            required
          />
          <input
            type="text"
            name="first_name"
            placeholder="*First name"
            style="text-align: center"
            required
          />
          <input
            type="text"
            name="last_name"
            placeholder="*Last Name"
            style="text-align: center"
            required
          />
          <input
            type="text"
            name="phone"
            placeholder="*No.Telp"
            style="text-align: center"
            required
          />
          <input
            type="date"
            name="birth_date"
            style="text-align: center"
            required
          />

          <textarea
            name="address"
            id=""
            cols="30"
            rows="3"
            placeholder="*Address"
            style="text-align: center"
            required
          ></textarea>
          <br />
          <h1>Account Security</h1>
          <input
            type="email"
            name="email"
            placeholder="*Email Address"
            style="text-align: center"
            required
          />

          <input
            type="password"
            name="password"
            placeholder="*Password"
            style="text-align: center"
            required
          />
          <button type="submit" name="register">Create An Account</button>
        </div>
      </div>
    </form>
  </body>
</html>
