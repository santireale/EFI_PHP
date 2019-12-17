<?php
  include('../PHP/app/database/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../PHP/assets/css/style.css">
  <title>Iniciar Sesión</title>
</head>
<body>
  <!-- header -->
  <?php 
    include('../PHP/app/includes/header.php');
  ?>
  <!-- // header -->
  <div class="auth-content">
    <form action="../PHP/checkRecover.php" method="post">
      <h3 class="form-title">Inicio de Sesión</h3>
      <div>
        <label>Email: </label>
        <input type="text" name="useremail" class="text-input">
      </div>
      <div>
        <button type="submit" name="login-btn" class="btn">Recuperar Contraseña</button>
      </div>
    </form>
  </div>
</body>
</html>
