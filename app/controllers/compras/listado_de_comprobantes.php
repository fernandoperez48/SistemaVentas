<?php
// listado_de_comprobantes.php

include '../../config.php'; // Ajusta la ruta según tu estructura de proyecto

try {
    $sql = "SELECT nro_comprobante FROM tb_compras";
    $result = $mysqli->query($sql);

    if ($result) {
        $comprobantes = $result->fetch_all(MYSQLI_ASSOC);
        $comprobantes_array = array_column($comprobantes, 'nro_comprobante');
        echo json_encode($comprobantes_array);
    } else {
        throw new Exception("Error en la consulta: " . $mysqli->error);
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
