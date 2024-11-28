<?php
include '../../config.php';

$codigo_venta = $_POST['codigo_venta'];
$direccion_envio = $_POST['Direccion'];
$fecha_envio = $_POST['fecha_envio'];
$estado = $_POST['estado'];
$descripcion = $_POST['descripcion'];
$nombre_usuario = $_POST['nombres_usuario'];

// Verificar si la venta ya tiene asignado un envío
$query_check_envio = "SELECT COUNT(*) AS total FROM tb_envios WHERE IdVenta = '$codigo_venta'";
$result_check_envio = $mysqli->query($query_check_envio);
$row_check_envio = $result_check_envio->fetch_assoc();

if ($row_check_envio['total'] > 0) {
    // Si ya existe un envío para esta venta
    session_start();
    $_SESSION['mensaje'] = "La venta ya tiene un envío asignado.";
    $_SESSION['icono'] = "warning";
    header('location: ' . $URL . 'envios/create.php');
    exit(); // Salir para evitar que continúe el script
}

// Si no existe un envío para la venta, continuar con el proceso
$query_cliente = "SELECT id_cliente FROM tb_ventas WHERE nro_venta = '$codigo_venta'";
$result_cliente = $mysqli->query($query_cliente);
$row_cliente = $result_cliente->fetch_assoc();
$codcliente = $row_cliente['id_cliente'];

$sql = "INSERT INTO tb_envios (IdVenta, IdCliente, Direccion, estado, FechaEnvio, descripcion, nombre_usuario) 
        VALUES ('$codigo_venta', '$codcliente', '$direccion_envio', '$estado', '$fecha_envio', '$descripcion', '$nombre_usuario')";

if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el envío correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . 'envios/');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar el envío.";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'envios/create.php');
}
