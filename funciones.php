<?php
// funciones.php

// Función para conectar a la base de datos
function conectar_base_datos() {
    $host = 'localhost';
    $usuario = 'root';
    $contraseña = '';
    $base_datos = 'distribuidos';

    // Crear la conexión
    $conn = new mysqli($host, $usuario, $contraseña, $base_datos);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

// Función para consultar la base de datos y obtener usuarios
function obtener_usuarios($conn) {
    $sql = "SELECT id, nombre, email FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Retornar los datos en un array
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Función para generar un reporte en HTML
function generar_reporte_usuarios($usuarios) {
    $html = '
    <h1>Reporte de Usuarios</h1>
    <table border="1" cellpadding="4">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    ';

    if (count($usuarios) > 0) {
        foreach ($usuarios as $usuario) {
            $html .= '
            <tr>
                <td>' . htmlspecialchars($usuario["id"]) . '</td>
                <td>' . htmlspecialchars($usuario["nombre"]) . '</td>
                <td>' . htmlspecialchars($usuario["email"]) . '</td>
            </tr>
            ';
        }
    } else {
        $html .= '<tr><td colspan="3">No hay usuarios registrados</td></tr>';
    }

    $html .= '</table>';
    return $html;
}

// Función para cerrar la conexión a la base de datos
function cerrar_conexion($conn) {
    $conn->close();
}
?>
