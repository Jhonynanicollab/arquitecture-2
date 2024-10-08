<?php
// generar_pdf.php
ob_start(); // Iniciar el buffer de salida
require_once('TCPDF-main/tcpdf.php'); // Asegúrate de que la ruta a TCPDF sea correcta
require_once('conexion.php'); // Incluir el archivo de conexión

// Crear un nuevo documento PDF
$pdf = new TCPDF();

// Configuración del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Título del Reporte');
$pdf->SetSubject('Asunto del Reporte');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Configurar márgenes
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 15);

// Agregar una página
$pdf->AddPage();

// Consulta a la base de datos
$sql = "SELECT id, nombre, email FROM usuarios"; // Cambia la tabla y columnas según tu base de datos
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Contenido HTML para el PDF
$html = '
<h1>Reporte de Usuarios</h1>
<table border="1" cellpadding="4">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
    </tr>
';

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Salida de cada fila
    while ($row = $result->fetch_assoc()) {
        $html .= '
        <tr>
            <td>' . htmlspecialchars($row["id"]) . '</td>
            <td>' . htmlspecialchars($row["nombre"]) . '</td>
            <td>' . htmlspecialchars($row["email"]) . '</td>
        </tr>
        ';
    }
} else {
    $html .= '<tr><td colspan="3">No hay usuarios registrados</td></tr>';
}

$html .= '</table>';

// Escribir el contenido HTML al PDF
$pdf->writeHTML($html, true, false, true, false, '');

ob_end_clean(); // Limpiar el buffer de salida

// Cerrar y generar el PDF
$pdf->Output('reporte_usuarios.pdf', 'I'); // 'I' para visualizar en el navegador

// Cerrar conexión
$conn->close();
