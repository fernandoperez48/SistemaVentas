
<?php
include '../../config.php'; // Asegúrate de que la configuración de la base de datos esté incluida

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nro_venta = $_POST['nro_venta'];

    // Verificar si el nro_venta está definido
    if (isset($nro_venta) && !empty($nro_venta)) {

        // Iniciar una transacción
        $mysqli->begin_transaction();

        try {
            // Paso 1: Obtener los productos de la venta en tb_carrito
            $sql_carrito = "SELECT id_producto, cantidad FROM tb_carrito WHERE nro_venta = ?";
            $stmt_carrito = $mysqli->prepare($sql_carrito);
            $stmt_carrito->bind_param('s', $nro_venta);
            $stmt_carrito->execute();
            $resultado_carrito = $stmt_carrito->get_result();

            // Verificar si la venta tiene productos en el carrito
            if ($resultado_carrito->num_rows > 0) {
                // Paso 2: Iterar sobre los productos y actualizar el stock en tb_almacen
                while ($fila = $resultado_carrito->fetch_assoc()) {
                    $id_producto = $fila['id_producto'];
                    $cantidad = $fila['cantidad'];

                    // Actualizar el stock en tb_almacen (sumar la cantidad)
                    $sql_stock = "UPDATE tb_almacen SET stock = stock + ? WHERE id_producto = ?";
                    $stmt_stock = $mysqli->prepare($sql_stock);
                    $stmt_stock->bind_param('ii', $cantidad, $id_producto);
                    $stmt_stock->execute();

                    if ($stmt_stock->affected_rows === 0) {
                        throw new Exception("No se pudo actualizar el stock para el producto ID: $id_producto");
                    }
                }
            } else {
                throw new Exception("No se encontraron productos para la venta nro_venta = $nro_venta");
            }

            // Paso 3: Anular la venta (actualizar estadoVenta a 'anulada' en tb_ventas)
            $sql_venta = "UPDATE tb_ventas SET estadoVenta = 'anulada' WHERE nro_venta = ?";
            $stmt_venta = $mysqli->prepare($sql_venta);
            $stmt_venta->bind_param('s', $nro_venta);
            $stmt_venta->execute();

            if ($stmt_venta->affected_rows === 0) {
                throw new Exception("No se pudo anular la venta con nro_venta = $nro_venta");
            }

            // Si todo ha ido bien, confirmar la transacción
            $mysqli->commit();
            echo "Venta anulada correctamente y stock actualizado.";
        } catch (Exception $e) {
            // Si ocurre algún error, hacer rollback de la transacción
            $mysqli->rollback();
            echo "Error: " . $e->getMessage();
        }

        // Cerrar las sentencias preparadas
        $stmt_carrito->close();
        $stmt_stock->close();
        $stmt_venta->close();
    } else {
        echo "Número de venta no proporcionado.";
    }
} else {
    echo "Método de solicitud no permitido.";
}

$mysqli->close();
?>

