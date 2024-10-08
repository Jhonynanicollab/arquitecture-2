<?php
// conexion.php
$servername = "localhost"; // o "127.0.0.1"
$username = "root"; // nombre de usuario por defecto en XAMPP
$password = ""; // contraseña por defecto en XAMPP (debería ser vacía)
$dbname = "distribuidos"; // nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
