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
  <title>New Post</title>
</head>
<body>
    <?php
        include('../PHP/app/includes/header.php');
        if (isset($_SESSION['error'])){ // Verifico si existe error (mensaje) que deba mostrarle al usuario
          if (!empty($_SESSION['error'])){
          ?>
            <script type="text/javascript">alert('<?php echo$_SESSION['error']?>');</script> 
          <?php
          $_SESSION['error'] = ''; // Reseteo el error por si necesito mostrar uno nuevo.
          }
        }
        if(isset($_SESSION['useremail'])) {  // Si existe usuario logeado actualmente, permito crear nueva publicacion
    ?>
    <div class="auth-content">
     <form action="../PHP/ctrl-newPost.php" method="post">
      <h3 class="form-title">Nueva publicación</h3>
      <div>
        <label>Titulo: </label>
        <input type="text" name="title-post" class="text-input" value="">
      </div>
      <div>
        <label>Contenido: </label>
        <textarea type="text-area" name="content-post" class="textarea"></textarea>
      </div>
      <div>
        <label for="foto">Ingrese URL: </label>
        <input class="text-input" type="text" name="image-post">
      </div>
      <div>
        <label>Categoria: </label>
        <select name="category-post" id="categoria" class="text-input">
        <?php   
            $resultsCategory = selectAllCategory(); // Obtengo ols datos de todas las categorias
            foreach($resultsCategory as $row) { ?> 
            <option value="<?php echo $row['id'] ?>" ><?php echo $row['nombre'] ?></option>
        <?php
            }
        ?>
        </select>
      <div>
          <form>
            <button type="submit" name="btn-mypost btn-mypost-new" class="btn">Crear</button>
          </form>
      </div>
    </form>
        </div>
    <?php
        } else
        {
            header("location: ../PHP/index.php");
        }
    ?>
</body>
</html>