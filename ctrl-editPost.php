<?php
include('../PHP/app/database/db.php');

if (isset($_GET['id'])){
    $cat = $_GET['id'];     
} else {
    header("location: ../PHP/index.php");
}

session_start();
if (isset($_SESSION['useremail'])){ // Verifico que la sesion existe (si hay usuario logeado)
    $resultsUser = selectOneUserByEmail($_SESSION['useremail']); // Obtengo datos del usuario logeado
    $resultsPost = selectOnePostById($cat); // Obtengo datos del post seleccionado
    if ( $resultsUser['id'] === $resultsPost['user_id']){ // Verifico que el post fue creado por el usuario logeado actualmente
        $title = $_POST['title-post'];
        $descript = $_POST['content-post'];
        $category = $_POST['category-post'];
        $image = $_POST['image-post'];
        if(empty($title) or empty($descript)){ // No se puede editar el post si existen campos vacios
            $_SESSION['error'] = ' Existen campos vacios. '; 
            header("location: ../PHP/myPosts.php");
        } else { // Todo correcto, procedo a editar el post
            $idPost = $resultsPost['id']; 
            editPost($title, $descript, $category, $image, $idPost);
            $_SESSION['error'] = ' Su post a sido modificado correctamente. ';
            header("location: ../PHP/myPosts.php");    
        }    
    } else { // El usuario quiere modificar un post del cual no es autor.
        $_SESSION['error'] = ' Solo puede modificar posts de su autoria. ';
        header("location: ../PHP/index.php");
    }
} else { // Para 'editar' un post necesariamente debe encontrarse logeado
    header("location: ../PHP/index.php");
}
?>