<?php
include_once '../../config.php';

$nro_compra = $_GET['nro_compra'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$precio_unitario = $_GET['precio_unitario'];
$id_proveedor = $_GET['id_proveedor'];

// Verificar si ya existe un registro para este producto en esta compra
$sql_check_producto = "SELECT * FROM tb_detalle_compras WHERE nro_compra = '$nro_compra' AND id_producto = '$id_producto'";
$result_check_producto = $mysqli->query($sql_check_producto);

if ($result_check_producto->num_rows > 0) {
    // Si ya existe, actualizar la cantidad del producto
    $row = $result_check_producto->fetch_assoc();
    $cantidad_existente = $row['cantidad_producto'];
    $nueva_cantidad = $cantidad_existente + $cantidad;
    // Aquí se puede mostrar el mensaje de que se mantendrá el primer precio cargado
    mostrarMensajePrecio();

    $sql_update = "UPDATE tb_detalle_compras SET cantidad_producto = '$nueva_cantidad' WHERE nro_compra = '$nro_compra' AND id_producto = '$id_producto'";

    if ($mysqli->query($sql_update) === TRUE) {
        echo "<script>
            window.location.href = '$URL/compras/create.php';
        </script>";
    } else {
        // Manejar el error si la actualización no se realiza correctamente
        session_start();
        $_SESSION['mensaje'] = "Error al actualizar la cantidad del producto en la compra";
        $_SESSION['icono'] = "error";
        echo "<script>
            window.location.href = '$URL/compras/create.php';
        </script>";
    }
} else {
    // Si no existe, insertar el nuevo detalle de compra
    $sql_insert = "INSERT INTO tb_detalle_compras (nro_compra, id_producto, cantidad_producto, precio_unitario, id_proveedor) VALUES ('$nro_compra', '$id_producto', '$cantidad', '$precio_unitario', '$id_proveedor')";

    if ($mysqli->query($sql_insert) === TRUE) {
        echo "<script>
            window.location.href = '$URL/compras/create.php';
        </script>";
    } else {
        // Manejar el error si la inserción no se realiza correctamente
        session_start();
        $_SESSION['mensaje'] = "No se pudo registrar la compra";
        $_SESSION['icono'] = "error";
        echo "<script>
            window.location.href = '$URL/compras/create.php';
        </script>";
    }
}
function mostrarMensajePrecio()
{
    // Mostrar un mensaje de alerta o modal
    echo "<script>
        alert('Producto ya caragdo, se mantendrá el primer precio cargado.');
    </script>";
}

$mysqli->close();
