<?php
include '../../config.php';

$codigo_venta = $_POST['codigo_venta'];
$direccion_envio = $_POST['Direccion'];
$fecha_envio = $_POST['fecha_envio'];
$estado = $_POST['estado'];
$descripcion = $_POST['descripcion'];
$nombre_usuario = $_POST['nombres_usuario'];

// Consulta para obtener el código del cliente asociado a la venta
$query_cliente = "SELECT id_cliente FROM tb_ventas WHERE nro_venta = '$codigo_venta'";
$result_cliente = $mysqli->query($query_cliente);
$row_cliente = $result_cliente->fetch_assoc();
$codcliente = $row_cliente['id_cliente'];

$sql = "INSERT INTO tb_envios (IdVenta, IdCliente, Direccion, estado, FechaEnvio, descripcion,nombre_usuario) VALUES ('$codigo_venta', '$codcliente', '$direccion_envio', '$estado', '$fecha_envio', '$descripcion','$nombre_usuario')";

if ($mysqli->query($sql) === TRUE) {
    //echo "Guardado correctamente";
    session_start();
    $_SESSION['mensaje'] = "Se registró el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . 'envios/');
} else {
    //echo "No se guardó correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'envios/create.php');
}
