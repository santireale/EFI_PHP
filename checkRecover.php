<?php

include('../PHP/app/database/db.php');

$useremail = $_POST['useremail'];
$searchUser = selectOneUserByEmail($useremail);

if (empty($searchUser)){ // No fue ingresado el email al cual recuperar la contraseña (campo vacio)
    header("location: ../PHP/login.php");
} else
{
    $resultsUser = selectOneUserByEmail($useremail);
    if (empty($resultsUser)){ // No existe usuario registrado con el email obtenido
        session_start();
        $_SESSION['error'] = ' No existe usuario registrado con ese email. ';
    } else { // Si existe registro, procedo a enviar el email con la nueva contraseña
        $id = $searchUser['id'];
        $userfirstname = $searchUser['firstname'];
        $userlastname = $searchUser['lastname'];
        $useremail = $searchUser['email'];
        $userpassword = newPassword(); // Genero contraseña
        editUser($id, $userpassword); // Encripto contraseña
        require_once('../PHP/sendEmailRecuperation.php'); // Envio el email
        session_start();
        $_SESSION['error'] = ' Su contraseña a sido restaurada, verifique su email. '; // Alerto al usuario
        header("location: ../PHP/login.php");
    }
}


?>