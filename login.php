<?php
session_start(); // Iniciar la sesión
require_once('conexion.php'); // Incluir conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Seleccionar el usuario correspondiente al email
    $stmt = $conn->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['contraseña'])) {
            // Almacenar datos en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            header('Location: index.php'); // Redirigir a la página principal
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El correo no está registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Estilo CSS -->
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <p><a href="registrarse.php">¿No tienes cuenta? Regístrate aquí.</a></p>
</body>
</html>
