<?php

include('../PHP/app/database/db.php');

$useremail = $_POST['useremail']; // Obtengo el email ingresado por el usuario en el formulario
$userpassword = $_POST['userpassword']; // Obtengo la contraseña ingresada por el usuario
$userpassword = md5($userpassword); // Encripto la contraseña ingresada por el usuario

if (empty($useremail)){ // Alerto al usuairo que no completo el formulario con el email
    session_start();
    $_SESSION['error'] = ' Existen campos vacios. ';
    header("location: ../PHP/login.php");
} else {
    $searchUser = selectOneUserByEmail($useremail);
    if (empty($searchUser)){ // No existe registro con el email ingresado
        session_start();
        $_SESSION['error'] = ' Usuario inexsistente. ';
        header("location: ../PHP/login.php");
    } else
    {
        if (($useremail === $searchUser['email']) && ($searchUser['password'] === $userpassword)){  // Verifico que los datos
                                                                                                    // ingresados concuerden
                                                                                                    // con los obtenidos
            login($useremail);
            header("location: ../PHP/index.php");
        } else { // Usuario existente; Datos ingresados incorrectos
            session_start();
            $_SESSION['error'] = 'Datos invalidos';
            header("location: ../PHP/login.php");
        }
    }
}


?>