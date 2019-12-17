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
        <h1 class="recent-posts-title">Mis publicaciones</h1>
        <a href="../PHP/newPost.php"><button class="btn-mypost btn-mypost-new">Nueva</button></a>
        <br>
        <br>
        <!-- FOREACH -->
        <?php
          if (isset($_SESSION['error'])){ // Verifico si existe algun error (mensaje) que debe ser mostrado al usuario
            if (!empty($_SESSION['error'])){
            ?>
              <script type="text/javascript">alert('<?php echo$_SESSION['error']?>');</script>
            <?php
            $_SESSION['error'] = ''; // Reseteo el error (en el caso de que deba volver a mostrar algun otro error/mensaje )
          }
        }
        if (isset($_SESSION['useremail'])){ // Verifico si existe algun usuario logeado actualmente
          $resultsUser = selectOneUserByEmail($_SESSION['useremail']); // Obtengo datos del usuario (logeado)
          $id_usuario = $resultsUser['id']; // Defino el id
          $resultsPosts = selectAllPostByUser($resultsUser['id']); // Obtengo los datos de todos los posts del usuario actual
          foreach ($resultsPosts as $row) // Recorro el resultado obtenido
          {
            $id_categoria = $row['categoria_id'];
        ?>
          <div class="post clearfix">
            <img src="<?php echo $row['image'] ?>" class="post-image" alt=""> 
            <div class="post-content">
              <h2 class="post-title"><?php echo $row['titulo'] ?></h2>
              <div class="post-info">
              <i class="fa fa-user-o"></i><?php echo ' '.$resultsUser['lastname']?>, <?php echo $resultsUser['firstname']?></a>
              <br>
              <i class="fa fa-calendar"></i> Creado - Actualizado: <?php echo ' '.$row['creado'], ' - ', $row['actualizado'] ?>
              <?php
              $resultsCategory = selectOneCategory($id_categoria); // Obtengo los datos de todas las categorias
              ?>
              <br>
              <i class="fa fa-code"></i><a href="postCategory.php?id=<?php echo $id_categoria?>"> Categoria: <?php echo $resultsCategory['nombre']?></a>
              </div>
              <p class="post-body">
                  <?php echo $row['descripcion'] ?>
              </p>
              <a href="editPost.php?id=<?php echo $row['id']?>"><button class="btn-mypost btn-mypost-edit">Editar</button></a>
              <a href="deletePost.php?id=<?php echo $row['id']?>"><button class="btn-mypost btn-mypost-delete">Eliminar</button></a>
            </div>
          </div>
          <?php
          }
        } else {
          header("location: ../PHP/index.php");
        }
          ?>
        <!-- F FOREACH -->
      </div>
    </div>
    <!-- // content -->
  </div>
  <!-- // page wrapper -->
</body>
</html>