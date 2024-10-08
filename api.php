<?php
// api.php
header("Content-Type: application/json");
include 'conexion.php'; // Conexión a la base de datos
include 'Usuario.php';
$usuarioModel = new Usuario($conn);

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            obtener_usuario($_GET['id']);
        } else {
            obtener_usuarios();
        }
        break;
    case 'POST':
        crear_usuario();
        break;
    case 'PUT':
        actualizar_usuario($_GET['id']);
        break;
    case 'DELETE':
        eliminar_usuario($_GET['id']);
        break;
    default:
        http_response_code(405); // Método no permitido
        break;
}

function obtener_usuarios() {
    global $conn;
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($usuarios);
}

function obtener_usuario($id) {
    global $conn;
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    echo json_encode($usuario);
}

function crear_usuario() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"));
    $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $data->nombre, $data->email);
    if ($stmt->execute()) {
        http_response_code(201); // Creado
    } else {
        http_response_code(400); // Solicitud incorrecta
    }
}

function actualizar_usuario($id) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"));
    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $data->nombre, $data->email, $id);
    if ($stmt->execute()) {
        http_response_code(200); // Actualizado
    } else {
        http_response_code(400); // Solicitud incorrecta
    }
}

function eliminar_usuario($id) {
    global $conn;
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        http_response_code(204); // Sin contenido
    } else {
        http_response_code(400); // Solicitud incorrecta
    }
}
