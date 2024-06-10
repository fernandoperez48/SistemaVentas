<?php
include '../../config.php';

// Obtener los valores desde la solicitud GET
$nombre_proveedor = $_GET['nombre_proveedor'];
$empresa = $_GET['empresa'];
$cuit = $_GET['cuit'];

// Inicializar las variables para los mensajes de error
$duplicados = [];

// Verificar si ya existe un proveedor con el mismo nombre_proveedor
$sql_verificar_nombre = "SELECT * FROM tb_proveedores WHERE nombre_proveedor = ?";
$stmt_nombre = $mysqli->prepare($sql_verificar_nombre);
$stmt_nombre->bind_param('s', $nombre_proveedor);
$stmt_nombre->execute();
$result_nombre = $stmt_nombre->get_result();
if ($result_nombre->num_rows > 0) {
    $duplicados[] = 'nombre de proveedor';
}

// Verificar si ya existe un proveedor con el mismo cuit
$sql_verificar_cuit = "SELECT * FROM tb_proveedores WHERE cuit = ?";
$stmt_cuit = $mysqli->prepare($sql_verificar_cuit);
$stmt_cuit->bind_param('s', $cuit);
$stmt_cuit->execute();
$result_cuit = $stmt_cuit->get_result();
if ($result_cuit->num_rows > 0) {
    $duplicados[] = 'CUIT';
}

// Verificar si ya existe un proveedor con la misma empresa
$sql_verificar_empresa = "SELECT * FROM tb_proveedores WHERE empresa = ?";
$stmt_empresa = $mysqli->prepare($sql_verificar_empresa);
$stmt_empresa->bind_param('s', $empresa);
$stmt_empresa->execute();
$result_empresa = $stmt_empresa->get_result();
if ($result_empresa->num_rows > 0) {
    $duplicados[] = 'empresa';
}

// Preparar el mensaje de respuesta
if (!empty($duplicados)) {
    $mensaje = "Ya existe un proveedor con igual " . implode(", ", $duplicados) . ".";
    echo json_encode([
        'status' => 'error',
        'message' => $mensaje
    ]);
} else {
    echo json_encode([
        'status' => 'success',
        'message' => 'No existe un proveedor con el mismo nombre, CUIT o empresa.'
    ]);
}
