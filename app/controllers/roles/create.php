<?php
include '../../config.php';

$rol = $_POST['rol'];

$sql = "INSERT INTO tb_roles (rol, fyh_creacion) VALUES ('$rol', '$fechaHora')";

if ($mysqli->query($sql) === TRUE) {
    //echo "Guardado correctamente";
    session_start();
    $_SESSION['mensaje'] = "Se registró el rol correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/roles/');
} else {
    //echo "No se guardó correctamente";
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar el rol";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . '/roles/create.php');
}
