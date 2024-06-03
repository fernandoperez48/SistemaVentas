<?php
require '../../config.php';

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    // Actualiza el nombre de la tabla a tb_almacen
    $query = "SELECT id_proveedor FROM tb_almacen WHERE id_producto = ?";
    $stmt = $mysqli->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . $mysqli->error);
    }
    $stmt->bind_param('i', $id_producto);
    if (!$stmt->execute()) {
        die('Execute failed: ' . $stmt->error);
    }
    $stmt->bind_result($id_proveedor);
    if (!$stmt->fetch()) {
        die('Fetch failed: ' . $stmt->error);
    }
    $stmt->close();

    echo $id_proveedor;
} else {
    echo 'id_producto no establecido';
}
