<?php
include '../../config.php';

// Recuperar el ID del cliente a eliminar
$id_cliente = $_POST['id_cliente'];

// Preparar y ejecutar la consulta de eliminación
$sql_delete = "DELETE FROM tb_clientes WHERE id_cliente = '$id_cliente'";
$mysqli->query($sql_delete);

// Iniciar sesión y establecer mensajes
session_start();
$_SESSION['mensaje'] = "Se eliminó el usuario correctamente";
$_SESSION['icono'] = "success";

// Redireccionar después de la eliminación
header('location: ' . $URL . 'clientes/indexemp.php');
