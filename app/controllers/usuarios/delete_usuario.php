<?php
include '../../config.php';

$id_usuario = $_POST['id_usuario'];

$sql = "DELETE FROM tb_usuarios WHERE id_usuarios = '$id_usuario'";

if ($mysqli->query($sql) === TRUE) {
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el usuario correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . 'usuarios/');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar el usuario";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . 'usuarios/');
}

$mysqli->close();
