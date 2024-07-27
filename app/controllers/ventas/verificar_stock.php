<?php
include '../../config.php';

$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];

$sql = "SELECT stock FROM tb_almacen WHERE id_producto='$id_producto'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

if ($row['stock'] >= $cantidad) {
    echo json_encode(['stock_suficiente' => true]);
} else {
    echo json_encode(['stock_suficiente' => false]);
}

$mysqli->close();
