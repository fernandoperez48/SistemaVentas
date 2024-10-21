<?php

include '../../config.php';

// Verificar si los parámetros existen antes de acceder a ellos
//$nro_compra = isset($_GET['nro_compra']) ? $_GET['nro_compra'] : '';
$id_proveedor = isset($_GET['id_proveedor']) ? $_GET['id_proveedor'] : '';
$fecha_operacion = isset($_GET['fecha_operacion']) ? $_GET['fecha_operacion'] : '';
$ingreso_mercaderia = isset($_GET['ingreso_mercaderia']) ? $_GET['ingreso_mercaderia'] : '';
$comprobante = isset($_GET['comprobante']) ? $_GET['comprobante'] : '';
$precio_compra = isset($_GET['precio_compra']) ? $_GET['precio_compra'] : '';
$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
$resultado = $_GET['resultado'];
$explicacion_diferencia = $_GET['explicacion_diferencia']; // Recibir la explicación
$id_productos = isset($_GET['id_productos']) ? json_decode($_GET['id_productos'], true) : [];
$cantidades = isset($_GET['cantidades']) ? json_decode($_GET['cantidades'], true) : [];

$fyh_creacion = date('Y-m-d H:i:s');

$mysqli->begin_transaction();
// Obtengo el último valor de compra que creé en el detalle de compra
$sql_max_nro_compra = "SELECT MAX(nro_compra) AS ultimo_nro_compra FROM tb_compras";
$result = $mysqli->query($sql_max_nro_compra);

if ($result) {
    $row = $result->fetch_assoc();
    $ultimo_nro_compra = $row['ultimo_nro_compra'];
} else {
    // Manejar el error de la consulta
    echo "Error al obtener el último número de compra: " . $mysqli->error;
    exit(); // Salir si no se puede obtener el último nro_compra
}

// Actualiza la compra
$update_query = "UPDATE tb_compras 
SET 
    fecha_compra_pago = '$fecha_operacion', 
    id_proveedor = '$id_proveedor', 
    nro_comprobante = '$comprobante', 
    id_usuario = '$id_usuario', 
    costo = '$precio_compra', 
    fecha_ingreso_mercaderia = '$ingreso_mercaderia', 
    fecha_registro = '$fyh_creacion', 
    resultado = '$resultado', 
    explicacion_diferencia = '$explicacion_diferencia' 
WHERE 
    nro_compra = '$ultimo_nro_compra'";



// Ejecutar la consulta de actualizacion
if ($mysqli->query($update_query)) {
    // Inicializamos una variable para verificar si se superó el stock máximo
    $se_supero_maximo = false;
    // Si la actualizacion fue exitosa, obtenemos los precios unitarios y actualizamos el stock y el precio de compra
    for ($i = 0; $i < count($id_productos); $i++) {
        $id_producto = $id_productos[$i];
        $cantidad = $cantidades[$i];

        // Obtener el precio unitario del producto desde tb_detalle_compras
        $precio_unitario = obtenerPrecioUnitario($mysqli, $ultimo_nro_compra, $id_producto);

        // Actualizar el stock del producto en la base de datos y precio de compram Y LA ULTIMA FECHA DE INGRESO
        $update_query = "UPDATE tb_almacen SET stock = stock + '$cantidad', precio_compra = '$precio_unitario', fecha_ultimo_ingreso = '$ingreso_mercaderia' WHERE id_producto = '$id_producto'";

        if ($mysqli->query($update_query)) {
            // Verificar si el stock actualizado supera el stock máximo permitido
            $stock_actualizado = obtenerStockActualizado($mysqli, $id_producto);
            $stock_maximo = obtenerStockMaximo($mysqli, $id_producto);
            if ($stock_actualizado > $stock_maximo) {
                $se_supero_maximo = true;
                $nombre_producto = obtenerNombreProducto($mysqli, $id_producto);
            }
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

// Función para obtener el precio unitario de un producto en una compra específica
function obtenerPrecioUnitario($mysqli, $ultimo_nro_compra, $id_producto)
{
    $query = "SELECT precio_unitario FROM tb_detalle_compras WHERE nro_compra = '$ultimo_nro_compra' AND id_producto = '$id_producto'";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['precio_unitario'];
    } else {
        return 0;
    }
}

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
