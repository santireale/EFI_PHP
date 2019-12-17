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
  <!-- Custom Styles -->
  <link rel="stylesheet" href="../PHP/assets/css/style.css">
  <title>Mi Blog</title>
</head>
<body>
  <!-- header -->
  <?php include('../PHP/app/includes/header.php'); ?>
  <!-- // header -->
  <!-- Page wrapper -->
  <div class="page-wrapper">
    <!-- content -->
    <div class="content clearfix">
      <div class="page-content">
        <h1 class="recent-posts-title">Publicaciones Por Categoria</h1>

        <!-- FOREACH -->
        <?php
            if (isset($_GET['id'])){ // Obtengo el ID de la categoria seleccionada
                $cat = $_GET['id']; 
            }
          $results = selectAllPostByCategory($cat); // Obtengo los datos de todas las publicaciones que coinciden con la categoria seleccionada
          if (empty($results)){ // Verifico si existe publicaciones con la categoria seleccionada
            ?>
              <h2 class="post-title">No existen post de esta categoria :(</h2>
            <?php
          }
          foreach ($results as $row) // Muestro los resultados obtenidos
          {
            $id_usuario = $row['user_id'];
            $id_categoria = $row['categoria_id'];
        ?>
          <div class="post clearfix">
            <img src="<?php echo $row['image'] ?>" class="post-image" alt=""> 
            <div class="post-content">
              <h2 class="post-title"><?php echo $row['titulo'] ?></h2>
              <div class="post-info">
              <?php
                $resultsUser = selectOneUserById($id_usuario); // Obtengo datos del autor (para mostrar por quien fue publicado el post)
              ?>
              <i class="fa fa-user-o"></i><a href="postUser.php?id=<?php echo $id_usuario?>"> <?php echo $resultsUser['lastname']?>, <?php echo $resultsUser['firstname']?></a>
              <br>
              <i class="fa fa-calendar"></i>Creado - Actualizado: <?php echo $row['creado'], ' - ', $row['actualizado'] ?>
              <?php
              $resultsCategory = selectOneCategory($id_categoria); // Obtengo datos de UNA categoria
              ?>
              <br>
              <i class="fa fa-code"></i><a href="postCategory.php?id=<?php echo $id_categoria?>">Categoria: <?php echo $resultsCategory['nombre']?></a>
              </div>
              <p class="post-body"><?php echo $row['descripcion'] ?></p>
            </div>
          </div>
          <?php
          }
          ?>
        <!-- F FOREACH -->
      </div>
      <div class="sidebar">
        <!-- sidebar -->
        <?php include('../PHP/app/includes/sideBar.php'); ?>
        <!-- // sidebar -->
      </div>
    </div>
    <!-- // content -->
  </div>
  <!-- // page wrapper -->
</body>
</html>