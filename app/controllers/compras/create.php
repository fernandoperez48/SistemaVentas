<?php

include '../../config.php';

// Verificar si los parámetros existen antes de acceder a ellos
$nro_compra = isset($_GET['nro_compra']) ? $_GET['nro_compra'] : '';
$id_proveedor = isset($_GET['id_proveedor']) ? $_GET['id_proveedor'] : '';
$fecha_operacion = isset($_GET['fecha_operacion']) ? $_GET['fecha_operacion'] : '';
$ingreso_mercaderia = isset($_GET['ingreso_mercaderia']) ? $_GET['ingreso_mercaderia'] : '';
$comprobante = isset($_GET['comprobante']) ? $_GET['comprobante'] : '';
$precio_compra = isset($_GET['precio_compra']) ? $_GET['precio_compra'] : '';
$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
$id_productos = isset($_GET['id_productos']) ? json_decode($_GET['id_productos'], true) : [];
$cantidades = isset($_GET['cantidades']) ? json_decode($_GET['cantidades'], true) : [];

// Agregamos un mensaje de alerta para verificar la recepción de los datos
echo "Datos recibidos:<br>";
echo "Nro Compra: " . $nro_compra . "<br>";
echo "ID Proveedor: " . $id_proveedor . "<br>";
echo "Fecha Operación: " . $fecha_operacion . "<br>";
echo "Ingreso Mercadería: " . $ingreso_mercaderia . "<br>";
echo "Comprobante: " . $comprobante . "<br>";
echo "Precio Compra: " . $precio_compra . "<br>";
echo "ID Usuario: " . $id_usuario . "<br>";
echo "ID Productos: " . json_encode($id_productos) . "<br>";
echo "Cantidades: " . json_encode($cantidades) . "<br>";

$fyh_creacion = date('Y-m-d H:i:s');

$mysqli->begin_transaction();

// Inserta la compra
$insert_query = "INSERT INTO tb_compras (nro_compra, fecha_compra_pago, id_proveedor, nro_comprobante, id_usuario, costo, fecha_ingreso_mercaderia, fecha_registro) 
VALUES ('$nro_compra', '$fecha_operacion', '$id_proveedor', '$comprobante', '$id_usuario', '$precio_compra', '$ingreso_mercaderia', '$fyh_creacion')";

// Ejecutar la consulta de inserción
if ($mysqli->query($insert_query)) {
    // Inicializamos una variable para verificar si se superó el stock máximo
    $se_supero_maximo = false;
    // Si la inserción fue exitosa, actualiza el stock de cada producto comprado
    for ($i = 0; $i < count($id_productos); $i++) {
        $id_producto = $id_productos[$i];
        $cantidad = $cantidades[$i];
        // Actualizar el stock del producto en la base de datos
        $update_query = "UPDATE tb_almacen SET stock = stock + '$cantidad', precio_compra = '$precio_compra' WHERE id_producto = '$id_producto'";

        if ($mysqli->query($update_query)) {
            // Verificar si el stock actualizado supera el stock máximo permitido
            $stock_actualizado = obtenerStockActualizado($mysqli, $id_producto);
            $stock_maximo = obtenerStockMaximo($mysqli, $id_producto);
            if ($stock_actualizado > $stock_maximo) {
                $se_supero_maximo = true;
                $nombre_producto = obtenerNombreProducto($mysqli, $id_producto);
            }
            echo "El stock del producto $nombre_producto ha sido actualizado correctamente.<br>";
        } else {
            echo "Error al actualizar el stock del producto con ID $id_producto: " . $mysqli->error . "<br>";
        }
    }
    // Realizar el commit de la transacción si todas las operaciones fueron exitosas
    $mysqli->commit();
    if ($se_supero_maximo) {
        echo "<script>alert('La compra se ha registrado exitosamente. Sin embargo, el stock del producto $nombre_producto ha superado el stock máximo permitido.');</script>";
    } else {
        echo "<script>alert('La compra se ha registrado exitosamente.');</script>";
    }
} else {
    // Si hubo algún error en la inserción de la compra, realizar el rollback de la transacción
    $mysqli->rollback();
    echo "Error al registrar la compra: " . $mysqli->error;
}

// Cerrar la conexión a la base de datos
$mysqli->close();

// Función para obtener el stock actualizado de un producto
function obtenerStockActualizado($mysqli, $id_producto)
{
    $query = "SELECT stock FROM tb_almacen WHERE id_producto = '$id_producto'";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['stock'];
    } else {
        return 0;
    }
}

// Función para obtener el stock máximo de un producto
function obtenerStockMaximo($mysqli, $id_producto)
{
    $query = "SELECT stock_maximo FROM tb_almacen WHERE id_producto = '$id_producto'";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['stock_maximo'];
    } else {
        return 0;
    }
}

// Función para obtener el nombre del producto
function obtenerNombreProducto($mysqli, $id_producto)
{
    $query = "SELECT nombre FROM tb_almacen WHERE id_producto = '$id_producto'";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nombre'];
    } else {
        return 'Producto Desconocido';
    }
}
