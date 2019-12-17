<?php

include('../PHP/app/database/db.php');

$userfirstname = $_POST['userfirstname'];
$userlastname = $_POST['userlastname'];
$useremail = $_POST['useremail'];
$userpassword = $_POST['userpassword'];
$userpasswordconfirm = $_POST['userpasswordconfirm'];

$searchUser = selectOneUserByEmail($useremail);

if (empty($searchUser)){ // No existe usuario registrado con ese email

    if ($userpassword !== $userpasswordconfirm){ // Las contraseña ingresadas no coinciden
        session_start();
        $_SESSION['error'] = ' Las contraseñas no coinciden. ';
        header("location: ../PHP/register.php");
    } else {
        if(empty($userfirstname) or empty($userlastname)){ // Nombre o apellido faltantes.
            session_start();
            $_SESSION['error'] = ' Existen campos vacios. ';
            header("location: ../PHP/register.php");
        } else { // Obtengo todos los datos desde el formulario y procedo a la creacion del nuevo usuario
            createUser($userfirstname, $userlastname, $userpassword, $useremail);
            require_once('../PHP/sendEmailRegistration.php');
            logout();
            session_start();
            $_SESSION['error'] = ' Usuario registrado con exito. Verifique su email para obtener sus datos de acceso. '; // Alerto al
                                                                                                                         //usuario
            header("location: ../PHP/login.php");
        }
    } 
} else { // Ya existe usuario creado con el email ingresado
    session_start();
    $_SESSION['error'] = ' Ya existe un usuario con ese email. ';
    header("location: ../PHP/login.php");
}


?>