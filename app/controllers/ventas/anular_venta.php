
<?php
include '../../config.php'; // Asegúrate de que la configuración de la base de datos esté incluida

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nro_venta = $_POST['nro_venta'];

    // Verificar si el nro_venta está definido
    if (isset($nro_venta) && !empty($nro_venta)) {
        $sql = "UPDATE tb_ventas SET estado = 'anulada' WHERE nro_venta = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $nro_venta);
        if ($stmt->execute()) {
            echo "Venta anulada correctamente.";
        } else {
            echo "Error al anular la venta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Número de venta no proporcionado.";
    }
} else {
    echo "Método de solicitud no permitido.";
}

$mysqli->close();
?>
