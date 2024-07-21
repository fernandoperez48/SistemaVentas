<?php
include '../../config.php';

// Verificar si se ha enviado el número de compra
if (!isset($_POST['nro_compra'])) {
    die(json_encode(['exists' => false]));
}

$numero_compra = $_POST['nro_compra'];

// Consultar si existen registros con el número de compra
$sqlCheck = "SELECT COUNT(*) AS count FROM tb_detalle_compras WHERE nro_compra = ?";
$stmtCheck = $mysqli->prepare($sqlCheck);
$stmtCheck->bind_param('i', $numero_compra);
$stmtCheck->execute();
$stmtCheck->bind_result($count);
$stmtCheck->fetch();
$stmtCheck->close();

// Cerrar la conexión
$mysqli->close();

// Devolver resultado en formato JSON
echo json_encode(['exists' => $count > 0]);
