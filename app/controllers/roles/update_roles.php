<?php
include '../../config.php';

$id_rol_get = $_GET['id'];

// Consulta SQL para obtener los datos del rol
$sql_roles = "SELECT * FROM tb_roles WHERE id_rol = '$id_rol_get'";
$resultado = $mysqli->query($sql_roles);

// Inicializar la variable $rol
$rol = '';

// Verificar si se encontraron datos
if ($resultado->num_rows > 0) {
    // Obtener los datos del rol
    $roles_datos = $resultado->fetch_assoc();
    $rol = $roles_datos['rol'];
}
