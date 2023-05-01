<?php
/* Credenciales de la base de datos. Suponiendo que está ejecutando MySQL
servidor con configuración predeterminada (usuario 'root' sin contraseña) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'practica_3_cqcm');
 
/* Conexión a la base de datos MySQL */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Verifica la conexión
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
