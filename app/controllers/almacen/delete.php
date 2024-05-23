<?php
include '../../config.php';

$id_producto = $_POST['id_producto'];

// Construcción de la consulta
$sql = "DELETE FROM tb_almacen WHERE id_producto='$id_producto'";

// Ejecución de la consulta y comprobación del resultado
if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . 'almacen/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Ocurrio un error al eliminar el producto";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'almacen/delete.php?id_producto=' . $id_producto);
}
