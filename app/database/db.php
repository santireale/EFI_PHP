<?php

require('connect.php');

//////////////////////////////////////////// CATEGORIA

function selectOneCategory($id) // Obtengo los datos de una categoria específica
{
    global $conn;
    $sql = "SELECT * FROM categorias where id = $id"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function selectAllCategory() // Obtengo los datos de todas las categorias
{
    global $conn;
    $sql = "SELECT * FROM categorias"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

//////////////////////////////////////////// FIN CATEGORIA

//////////////////////////////////////////// USUARIO

function selectOneUserById($id) // Obtengo los datos de un usuario según su ID
{
    global $conn;
    $sql = "SELECT * FROM users where id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function selectOneUserByEmail($email) // Obtengo los datos de un usuario según su EMAIL
{
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function createUser($fname, $lname, $passw, $email) // Creo un nuevo usuario
{
    $avatar = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFpAZq2cySRRYaBLuGkvdWMMEmbUuHK5PWHwW_h3R6iQQKeZqEmg&s';
    $passw = md5($passw);
    global $conn;
    $sql = "INSERT INTO  users (firstname,lastname,password,email,avatar) values('$fname','$lname','$passw','$email','$avatar')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

function editUser($id, $newpass) // Edito la contraseña del usuario (recuperacion de contraseña)
{
    global $conn;
    $newpass = md5($newpass);
    $sql = "UPDATE users SET password = '$newpass' WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return True;
}

/////////////////////////////////////////// FIN USUARIO

/////////////////////////////////////////// POSTS

function selectOnePostById($id){ // Obtengo los datos de una publicacion según el ID
    global $conn;
    $sql = "SELECT * FROM publicaciones WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

function selectAllPost() // Obtengo los datos de todas las publicaciones
{
    global $conn;
    $sql = "SELECT * FROM publicaciones ORDER BY creado DESC"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function selectAllPostByUser($userid) // Obtengo los datos de todas las publicaciones pertenecientes a un usuario
{
    global $conn;
    $sql = "SELECT * FROM publicaciones WHERE user_id = $userid ORDER BY creado DESC"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function selectAllPostByCategory($categid) // Obtengo los datos de todas las publicaciones pertenecientes a una categoria
{
    global $conn;
    $sql = "SELECT * FROM publicaciones WHERE categoria_id = $categid ORDER BY creado DESC"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function editPost($title, $descript, $category, $image, $id) // Edito los datos de alguna publicación
{
    global $conn;
    $sql = "UPDATE publicaciones SET titulo='$title',descripcion='$descript',categoria_id='$category',image='$image' WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return True;
}

function deletePost($id) // Elimino una publicación
{
    global $conn;
    $sql = "DELETE FROM publicaciones WHERE id=$id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return True;
}

function createPost($title, $descript, $image, $category, $user) // Creo una nueva publicación
{
    global $conn;
    $sql = "INSERT INTO publicaciones (titulo, descripcion, image, categoria_id, user_id) VALUES ('$title','$descript','$image','$category','$user')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return True;
}

/////////////////////////////////////////// FIN POSTS

////////////////////////////////////////// SESION

function login($datasession) // Creo/Inicio la sesión
{
    session_destroy();
    session_start();
    $_SESSION['useremail'] = $datasession;
}

function logout() // Cierre/Elimino la sesión
{
    session_start(); 
    session_destroy(); //Destruyo la sesion
    header('Location: '.'../PHP/index.php');
}

function newPassword() // Genero una nueva contraseña
{

// ¿ Semilla ?
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Caracteres validos para generar las nueva contraseña
 
function generate_string($input, $strength = 16) { // Función local que general contraseña
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
};
 
$new_pass = generate_string($permitted_chars,7);
return $new_pass;

}
////////////////////////////////////////// FIN SESION

?>
