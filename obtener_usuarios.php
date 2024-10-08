<?php
require_once('conexion.php'); // Incluir archivo de conexión
require_once('usuario.php'); // Incluir el archivo que define la clase Usuario

// Crear instancia de la clase Usuario
$usuario = new Usuario($conn);

// Obtener usuarios
$usuarios = $usuario->obtenerUsuarios();

// Devolver como JSON
header('Content-Type: application/json');
echo json_encode($usuarios);
?>
