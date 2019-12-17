<?php
    include('../PHP/app/database/db.php');

    if (isset($_GET['id'])){
        $cat = $_GET['id']; 
    }

    session_start();
    if(isset($_SESSION['useremail'])){ // Verifico que la sesion existe (si hay usuario logeado)
        $resultsUser = selectOneUserByEmail($_SESSION['useremail']);  // Obtengo datos del usuario
        $resultPost = selectOnePostById($cat);  // Obtengo datos del post
        if ($resultPost['user_id'] === $resultsUser['id']){ // Verifico que el post seleccionado fue creado con el usuario logeado actualmente
            deletePost($cat);
            header("location: ../PHP/myPosts.php"); 
        } 
    }
    header("location: ../PHP/index.php");
?>