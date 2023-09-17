<?php
session_start();
if (isset($_SESSION['id_user'])) {
  include("connect.php");
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบ</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <!-- Custom styles -->
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <!-- <div class="layer"></div> -->
  <main class="page-center">
    <h1 class="sign-up__title">เข้าสู่ระบบ UBONWLM</h1>

    <article class="col-lg-4 col-md-4">
      <!-- <p class="sign-up__subtitle">Sign in to your account to continue</p> -->
      <form class="sign-up-form form" action="auth/login_manager.php" method="post">
        <!-- <form class="sign-up-form form" action="auth/login_manager.php" method="post"> -->
        <label class="form-label-wrapper">
          <p class="form-label">อีเมล</p>
          <input class="form-input" name="email" type="email" placeholder="" required>
        </label>
        <label class="form-label-wrapper">
          <p class="form-label">รหัสผ่าน</p>
          <input class="form-input" name="password" type="password" placeholder="" required>
        </label>
        <!-- <a class="link-info forget-link" href="##">Forgot your password?</a> -->
        <!-- <label class="form-checkbox-wrapper">
        <input class="form-checkbox" type="checkbox" required>
        <span class="form-checkbox-label">Remember me next time</span>
      </label> -->
          <button class="form-btn primary-default-btn transparent-btn">เข้าสู่ระบบ</button>
      </form>
    </article>
  </main>
  <!-- Chart library -->
  <script src="./plugins/chart.min.js"></script>
  <!-- Icons library -->
  <script src="plugins/feather.min.js"></script>
  <!-- Custom scripts -->
  <script src="js/script.js"></script>
</body>

</html>