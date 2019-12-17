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
    if (isset($_SESSION['error'])){ // Verifico si existen algún error (mensaje) que deba ser mostrado al usuario
      if (!empty($_SESSION['error'])){
      ?>
        <script type="text/javascript">alert('<?php echo$_SESSION['error']?>');</script>
      <?php
      $_SESSION['error'] = '';
      }
    }
    if(!isset($_SESSION['useremail'])){ // Verifico que no existe una sesion actualmente corriendo
  ?>
  <!-- // header -->
  <div class="auth-content">
    <form action="../PHP/checkLogin.php" method="post">
      <h3 class="form-title">Inicio de Sesión</h3>
      <div>
        <label>Email: </label>
        <input type="text" name="useremail" class="text-input">
      </div>
      <div>
        <label>Constraseña: </label>
        <input type="password" name="userpassword" class="text-input">
      </div>
      <div>
        <button type="submit" name="login-btn" class="btn">Iniciar Sesión</button>
      </div>
      <br>
    </form>
    <form action="recoverAccount.php" method="post">
      <center>
        <button type="submit" class="btn-mypost btn-mypost-edit">¿ olvido su contraseña ?</button>
      </center>
    </form>
  </div>
</body>
</html>

<?php
  } else { // Si existe sesion alguna, redirecciono
    header("location: ../PHP/index.php");
  };
?>