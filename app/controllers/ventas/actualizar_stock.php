<?php
include '../../config.php';

$id_producto = $_GET['id_producto'];
$stock_calculado = $_GET['stock_calculado'];

$sql = "UPDATE tb_almacen SET stock='$stock_calculado' WHERE id_producto='$id_producto'";

if ($mysqli->query($sql) === TRUE) {
    echo "Guardado correctamente";
} else {
    echo "No se guardó correctamente";
}

$mysqli->close();
