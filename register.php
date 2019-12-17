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
  <title>Registrarse</title>
</head>
<body>
  <!-- header -->
  <?php
    include('../PHP/app/includes/header.php');
    if (isset($_SESSION['error'])){ // Verifico si existe algun error (mensaje) que deba ser mostrado al usuario
      if (!empty($_SESSION['error'])){
      ?>
        <script type="text/javascript">alert('<?php echo$_SESSION['error']?>');</script>
      <?php
      $_SESSION['error'] = ''; // Resesteo el error/mensaje
      }
    }
    if(!isset($_SESSION['useremail'])) { // Verifico que no exista una sesion actualmente corriendo
  ?>
  <!-- // header -->
  <div class="auth-content">
    <form action="../PHP/checkRegister.php" method="post">
      <h3 class="form-title">Registrarse</h3>
      <div>
        <label>Nombre: </label>
        <input type="text" name="userfirstname" class="text-input">
      </div>
      <div>
        <label>Apellido: </label>
        <input type="text" name="userlastname" class="text-input">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="useremail" class="text-input">
      </div>
      <div>
        <label>Contraseña</label>
        <input type="password" name="userpassword" class="text-input">
      </div>
      <div>
        <label>Confirmar Contraseña</label>
        <input type="password" name="userpasswordconfirm" class="text-input">
      </div>
      <div>
        <button type="submit" name="register-btn" class="btn">Registrarme</button>
      </div>
    </form>
  </div>
</body>
</html>

<?php
  } else { // Si existe lo redirecciono
    header("location: ../PHP/index.php");
  };
?>