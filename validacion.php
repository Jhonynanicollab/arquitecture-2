<?php
function validarEntrada($data) {
    $data = trim($data); // Eliminar espacios en blanco
    $data = stripslashes($data); // Eliminar barras invertidas
    $data = htmlspecialchars($data); // Convertir caracteres especiales a entidades HTML
    return $data;
}
?>
