<?php
include '../../config.php';

$rol = $_POST['rol'];
$id_rol = $_POST['id_rol'];

// Preparar la sentencia SQL
$sql = "UPDATE tb_roles 
        SET rol = ?, fyh_actualizacion = ?
        WHERE id_rol = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Vincular los parámetros
    $stmt->bind_param('ssi', $rol, $fechaHora, $id_rol);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se actualizó el rol correctamente";
        $_SESSION['icono'] = "success";
        header('location: ' . $URL . '/roles/');
    } else {
        session_start();
        $_SESSION['mensaje'] = "No se pudo actualizar el rol correctamente";
        $_SESSION['icono'] = "error";
        header('location: ' . $URL . 'roles/update.php?id=' . $id_rol);
    }
    // Cerrar la sentencia
    $stmt->close();
} else {
    // Si hay algún error en la preparación de la sentencia
    echo "Error: " . $mysqli->error;
}
