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
  <title>Delete Post</title>
</head>
<body>
    <?php
        include('../PHP/app/includes/header.php');
        if(isset($_SESSION['useremail'])) { // Verifico que existe un usuario logeado 
            if (isset($_GET['id'])){ // Obtengo el ID del post
                $cat = $_GET['id']; 
            }
            $resultsPost = selectOnePostById($cat); // Obtengo datos del post
            $resultsUser = selectOneUserByEmail($_SESSION['useremail']); // Obtengo datos del usuario (logeado actualmente)
            if ($resultsUser['id'] === $resultsPost['user_id']){ // Si coincide el autor del post con el usuario logeado, procedo            
    ?>
    <div class="auth-content">
    <form action="../PHP/ctrl-deletePost.php?id=<?php echo $resultsPost['id']?>" method="post">
      <h3 class="form-title">Eliminar publicación</h3>
      <div>
        <label>Titulo: </label>
        <input type="text" name="title-post" class="text-input" value="<?php echo $resultsPost['titulo']?>" disabled>
      </div>
      <div>
        <label>Contenido: </label>
        <textarea type="text-area" name="content-post" class="textarea" disabled><?php echo $resultsPost['descripcion']?></textarea>
      </div>
      <div>
          <label for="foto">Imagen URL: </label>
          <input class="text-input" type="text" name="image-post" value="<?php echo $resultsPost['image']?>" disabled>
      </div>
      <div>
        <label>Categoria: </label>
        <?php $cate = selectOneCategory($resultsPost['categoria_id'])?>
        <input name="category-post" id="categoria" class="text-input" value="<?php echo $cate['nombre']?>" disabled>
      </div>
        <button type="submit" name="btn-mypost btn-mypost-new" class="btn">Eliminar</button>
      </div>
    </form>
        </div>
    <?php
            }
        } else
        {
            header("location: ../PHP/index.php");
        }
    ?>
</body>
</html>