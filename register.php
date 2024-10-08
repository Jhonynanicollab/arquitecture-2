¿<?php
// register.php
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    // Verificar si el email ya está registrado
    $sqlVerificar = "SELECT email FROM usuarios WHERE email = ?";
    $stmtVerificar = $conn->prepare($sqlVerificar);
    $stmtVerificar->bind_param('s', $email);
    $stmtVerificar->execute();
    $resultVerificar = $stmtVerificar->get_result();

    if ($resultVerificar->num_rows > 0) {
        echo "Este correo ya está registrado.";
    } else {
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $nombre, $email, $contraseña);
        $stmt->execute();
        echo "Registro exitoso.";
    }
}
