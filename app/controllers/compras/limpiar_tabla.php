<?php
include '../../config.php';

// Verificar si se ha enviado el número de compra
if (!isset($_POST['nro_compra'])) {
    die('Número de compra no proporcionado.');
}

$numero_compra = $_POST['nro_compra'];

// Preparar y ejecutar la consulta de eliminación
$sqlLimpiar = "DELETE FROM tb_detalle_compras WHERE nro_compra = ?";
$stmt = $mysqli->prepare($sqlLimpiar);
$stmt->bind_param('i', $numero_compra);

$success = $stmt->execute();

// Cerrar la conexión
$stmt->close();
$mysqli->close();

// Retornar el resultado
echo json_encode(['success' => $success]);
