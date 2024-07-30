<?php
// Cambia estos valores según tu configuración
$host = 'localhost'; // o la dirección del servidor de tu base de datos
$user = 'root'; // tu nombre de usuario
$password = ''; // tu contraseña
$dbname = 'historial_clinico'; // nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
