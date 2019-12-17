<?php
?>

<header class="clearfix">
    <div class="logo">
      <a href="index.php">
        <h1 class="logo-text"><span>POST[+]</span></h1>
      </a>
    </div>
    <div class="fa fa-reorder menu-toggle"></div>
    <nav>
    <ul>
      <li><a href="index.php">Inicio</a></li>

    <?php
      session_start(); //
      if (isset($_SESSION['useremail'])) { // Dependiendo si exite o no una sesion iniciada actualmente muestro uno u otros botones !
        $useremail = $_SESSION['useremail'];
        $resultsUser = selectOneUserByEmail($useremail);
    ?>
      <li>
        <a href="#" class="userinfo">
          <i class="fa fa-user"></i>
          <?php echo $resultsUser['firstname'].', '.$resultsUser['lastname']?>
          <i class="fa fa-chevron-down"></i>
        </a>
          <ul class="dropdown">
            <li><a href="../PHP/profile.php">Mi Perfíl</a></li>
            <li><a href="../PHP/myPosts.php">Mis Publicaciones</a></li>
            <li><a href="../PHP/logout.php" class="logout">Cerrar Sesión</a></li>
          </ul>
        </li>
    </ul>
    <?php
      } else
      {
    ?>
      <li>
        <a href="#" class="userinfo">
          <i class="fa fa-user"></i>
          <?php echo 'Menu '?>
          <i class="fa fa-chevron-down"></i>
        </a>
          <ul class="dropdown">
            <li><a href="../PHP/register.php">Registrarse</a></li>
            <li><a href="../PHP/login.php">Iniciar Sesión</a></li>
          </ul>
        </li>
    <?php
      }
    ?>
      </ul>
    </nav>
  </header>
