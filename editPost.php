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
  <title>Editar Publicacion</title>
</head>
<body>
    <?php
        include('../PHP/app/includes/header.php');
        if (isset($_GET['id'])){ // Obtengo ID de la publicacion seleccionada para editar
          $cat = $_GET['id']; 
        }
        if (isset($_SESSION['error'])){ // Si existe algún error lo muestro
                                        // (lo utilizo para cuando es necesario mostrar por ejemplo: 'campos vacios')
          if (!empty($_SESSION['error'])){
          ?>
            <script type="text/javascript">alert('<?php echo$_SESSION['error']?>');</script>
          <?php
          $_SESSION['error'] = ''; // Borro el error existente
          }
        }           
        if(isset($_SESSION['useremail'])){ // Verifico que existe un usuario logeado actualmente
          $resultsPost = selectOnePostById($cat); // Obtengo datos del post
          $resultsUser = selectOneUserByEmail($_SESSION['useremail']); // Obtengo datos del usuario logado actualmente
          if ($resultsUser['id'] === $resultsPost['user_id']){ // VErifico que coinciden el autor del post con el usuario logeado actualmente
    ?>
    <div class="auth-content">
    <form action="../PHP/ctrl-editPost.php?id=<?php echo $resultsPost['id']?>" method="post">
      <h3 class="form-title">Editar publicación</h3>
      <div>
        <label>Titulo: </label>
        <input type="text" name="title-post" class="text-input" value="<?php echo $resultsPost['titulo']?>">
      </div>
      <div>
        <label>Contenido: </label>
        <textarea type="text-area" name="content-post" class="textarea"><?php echo $resultsPost['descripcion']?></textarea>
      </div>
      <div>
          <label for="foto">Ingrese URL: </label>
          <input class="text-input" type="text" name="image-post" value="<?php echo $resultsPost['image']?>">
      </div>
      <div>
        <label>Categoria: </label>
        <select name="category-post" id="categoria" class="text-input">
        <?php   
            $resultsCategory = selectAllCategory();  // Obtengo y despliego una lista con las categorias existentes
            foreach($resultsCategory as $row) { 
              if ($resultsPost['categoria_id'] === $row['id']){ ?> 
              <option value="<?php echo $row['id'] ?>" selected ><?php echo $row['nombre'] ?></option> <!-- Si es la categoria original del post, 
                                                                                                        la selecciono como predeterminada.
                                                                                                        Si no es la original, solamente la
                                                                                                        agrego a la lista desplegable-->
            <?php
              } else { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
              <?php }
            ?>
        <?php
            }
        ?>
        </select>
      </div>
        <button type="submit" name="btn-mypost btn-mypost-new" class="btn">Guardar</button>
      </div>
    </form>
        </div>
    <?php
            } else {
              header("location: ../PHP/index.php");
            }
        } else
        {
            header("location: ../PHP/index.php");
        }
    ?>
</body>
</html>