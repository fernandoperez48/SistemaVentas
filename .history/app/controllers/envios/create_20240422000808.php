<?php
include '../../config.php';

$codigo_venta = $_POST['codigo_venta'];
$direccion_envio = $_POST['Direccion'];
$fecha_envio = $_POST['fecha_envio'];
$estado = $_POST['estado'];
$descripcion = $_POST['descripcion'];
//$usuario = $_POST['usuario'];

// Consulta para obtener el código del cliente asociado a la venta
$query_cliente = $pdo->prepare("SELECT id_cliente FROM tb_ventas WHERE id_venta = :codigo_venta");
$query_cliente->bindParam(':codigo_venta', $codigo_venta);
$query_cliente->execute();
$result_cliente = $query_cliente->fetch(PDO::FETCH_ASSOC);

$codcliente = $result_cliente['id_cliente'];

$sentencia = $pdo->prepare("INSERT INTO tb_envios(IdVenta,IdCliente,Direccion,estado,Descripcion,FechaEnvio) VALUES (:codigo_venta,:codcliente,:direccion_envio,:estado,:descripcion,:fecha_envio);");

$sentencia->bindParam('codigo_venta', $codigo_venta);
$sentencia->bindParam('codcliente', $codcliente);
$sentencia->bindParam('direccion_envio', $direccion_envio);
$sentencia->bindParam('fecha_envio', $fecha_envio);
$sentencia->bindParam('estado', $estado);
$sentencia->bindParam('descripcion', $descripcion);
//$sentencia->bindParam('usuario', $filename);



if ($sentencia->execute()) {
    //echo "Guardado correctamente";
    session_start();
    $_SESSION['mensaje'] = "Se registro el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/envios/');
} else {
    //echo "No se guardo correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'envios/create.php');
}
