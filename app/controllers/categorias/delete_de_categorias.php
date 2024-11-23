<?php
include '../../config.php';

session_start();

$id_categoria = $_GET['id_categoria'];

$sql = "DELETE FROM tb_acategorias WHERE id_categoria = '$id_categoria'";

if ($mysqli->query($sql) === true) {
    $_SESSION['mensaje'] = "Se eliminó la categoría correctamente";
    $_SESSION['icono'] = "success";
    echo "success"; // Enviar un mensaje simple al frontend
} else {
    $_SESSION['mensaje'] = "No se pudo eliminar la categoría";
    $_SESSION['icono'] = "error";
    echo "error"; // Enviar un mensaje de error al frontend
}
