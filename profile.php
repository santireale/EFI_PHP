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
  <title>Perfil</title>
</head>
<body>
  <!-- header -->
  <?php 
    include('../PHP/app/includes/header.php');
    if(isset($_SESSION['useremail'])) { // Verifico que existe una sesion actualmente
        $resultsUser = selectOneUserByEmail($_SESSION['useremail']); // Obtengo los datos del usuario logeado actualmente
  ?>
  <!-- // header -->
  <div class="auth-content">
    <center>
        <img src="<?php echo $resultsUser['avatar'] ?>"/>
        <br>
        <br>
        <i class="fa fa-user"></i>
        Nombre: <?php echo ' '.$resultsUser['firstname'], ', ', $resultsUser['lastname'] ?>
        <br>
        <br>
        Email: <?php echo ' '.$resultsUser['email'] ?>
        <br>
        <br>
        Usuario desde: <?php echo ' '.$resultsUser['reg_date'] ?>
        <br>
        <br>
    </center>
  </div>
</body>
</html>

<?php
  } else 
  {
    header("location: ../PHP/index.php");
  };
?>