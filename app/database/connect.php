<?php

// Defino parametros de conección
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'password';
$dbname = 'itec_test';

// Creo una conección con la DB
$conn = new MySQLi($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error){
    die('Database connection error: ' . $conn->connect_error);
}

?>