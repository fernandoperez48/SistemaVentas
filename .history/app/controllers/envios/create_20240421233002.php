<?php
include '../../config.php';

$codigo_venta = $_POST['codigo'];
$direccion_envio = $_POST['direccion'];
$fecha_envio = $_POST['fecha'];
$estado = $_POST['estado'];
$descripcion = $_POST['descripcion'];
//$usuario = $_POST['usuario'];

$sentencia = $pdo->prepare("INSERT INTO tb_envios(IdVenta,IdCliente,Direccion,estado,Descripcion,FechaEnvio) VALUES (:codigo_venta,:direccion_envio,:fecha_envio,:estado,:descripcion);");

$sentencia->bindParam('codigo', $codigo);
$sentencia->bindParam('direccion', $nombre);
$sentencia->bindParam('fecha', $descripcion);
$sentencia->bindParam('estado', $stock);
$sentencia->bindParam('descripcion', $fecha_ingreso);
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
