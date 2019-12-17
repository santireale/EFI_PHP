<?php
include('../PHP/app/database/db.php');

session_start();
if (isset($_SESSION['useremail'])){ // Verifico que existe un usuario logeado momentaneamente
    $resultUser = selectOneUserByEmail($_SESSION['useremail']);

    $title = $_POST['title-post'];
    $descript = $_POST['content-post'];
    $image = $_POST['image-post'];
    $category = $_POST['category-post'];
    $userid = $resultUser['id'];

    if(empty($title) or empty($descript) or empty($category) or empty($image)) // Verifico si existe algun campo del formulario vacio
    {
        $_SESSION['error'] = ' Existen campos vacios. ';
        header("location: ../PHP/newPost.php");
    } else { // Procedo a crear el post
        createPost($title, $descript, $image, $category, $userid);
        $_SESSION['error'] = ' Su post fue creado correctamente. ';
        header("location: ../PHP/myPosts.php"); 
    }
} else { // Para crear un post necesariamente el usuario tiene que estar logeado
    header("location: ../PHP/index.php");
}
?>