<?php
session_start();
require 'functions.php';

// Pastikan user sudah login, jika sudah, redirect ke halaman profil
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    // exit();
}


if(isset($_POST["login"])) {
    login($_POST);
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
    <div class="backgroundbelakang">
      <div class="login">
        <div class="inputlogin">
          <img
            src="assets/images/logos/logo-transparent.png"
            alt=""
          />
          <form
            action=""
            method="POST"
          >
            <div class="posisiinput">
              <div class="boxinput">
                <i class="fa-regular fa-circle-user"></i>
                <input
                  type="email"
                  name="email"
                  style="color: black"
                  placeholder="*Username or E-mail"
                />
              </div>
              <div class="boxinput">
                <i class="fa-solid fa-lock"></i>
                <input
                  type="password"
                  name="password"
                  style="color: black"
                  placeholder="*Password"
                />
              </div>
              <button type="submit" name="login" class="btnlogin">Login</button>
            </div>
          </form>
          <div class="pindahregister">
            <h5>Don't have an account? Sign Up as User</h5>
            <a href="register.php?role=user"><button>Sign Up</button></a>
          </div>
          <div class="pindahregister" style="margin-top:10px; ">
            <h5>Don't have an account? Sign Up as Admin</h5>
            <a href="register.php?role=admin"><button style="margin-top:10px; background-color:white; color:#31452c; border:solid 1px #31452c">Sign Up</button></a>
          </div>
        </div>
        <div class="loginimg">
          <img src="assets/images/login-image.jpg" alt="" />
        </div>
      </div>
    </div>
  </body>
</html>
