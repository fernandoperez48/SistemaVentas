<?php
include_once '../../config.php';

$nro_venta = $_GET['nro_venta'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$fechaHora = date('Y-m-d H:i:s');

// Verificar si ya existe un registro para este producto en esta venta
$sql_check_producto = "SELECT * FROM tb_carrito WHERE nro_venta = '$nro_venta' AND id_producto = '$id_producto'";
$result_check_producto = $mysqli->query($sql_check_producto);

if ($result_check_producto->num_rows > 0) {
    // Si ya existe, actualizar la cantidad del producto
    $row = $result_check_producto->fetch_assoc();
    $cantidad_existente = $row['cantidad'];
    $nueva_cantidad = $cantidad_existente + $cantidad;

    $sql_update = "UPDATE tb_carrito SET cantidad = '$nueva_cantidad' WHERE nro_venta = '$nro_venta' AND id_producto = '$id_producto'";

    if ($mysqli->query($sql_update) === TRUE) {
        echo "<script>
            window.location.href = '$URL/ventas/create.php';
        </script>";
    } else {
        // Manejar el error si la actualización no se realiza correctamente
        session_start();
        $_SESSION['mensaje'] = "Error al actualizar la cantidad del producto en la venta";
        $_SESSION['icono'] = "error";
        echo "<script>
            window.location.href = '$URL/ventas/create.php';
        </script>";
    }
} else {
    // Si no existe, insertar el nuevo detalle de venta
    $sql_insert = "INSERT INTO tb_carrito (nro_venta, id_producto, cantidad, fyh_creacion) VALUES ('$nro_venta', '$id_producto', '$cantidad', '$fechaHora')";

    if ($mysqli->query($sql_insert) === TRUE) {
        echo "<script>
            window.location.href = '$URL/ventas/create.php';
        </script>";
    } else {
        // Manejar el error si la inserción no se realiza correctamente
        session_start();
        $_SESSION['mensaje'] = "No se pudo registrar la compra";
        $_SESSION['icono'] = "error";
        echo "<script>
            window.location.href = '$URL/ventas/create.php';
        </script>";
    }
}

$mysqli->close();
