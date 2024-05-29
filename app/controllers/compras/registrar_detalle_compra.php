<?php
include_once '../../config.php';

$nro_compra = $_GET['nro_compra'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$precio_unitario = $_GET['precio_unitario'];
$id_proveedor = $_GET['id_proveedor'];

// Aquí debemos verificar si el proveedor coincide con los ya registrados en esta compra
$sql_check_proveedor = "SELECT id_proveedor FROM tb_detalle_compras WHERE nro_compra = '$nro_compra'";
$result_check = $mysqli->query($sql_check_proveedor);

if ($result_check->num_rows > 0) {
    $row = $result_check->fetch_assoc();
    if ($row['id_proveedor'] != $id_proveedor) {
        echo "<script>
    alert('Todos los productos de una compra deben ser del mismo proveedor');
    window.location.href = '$URL/compras/create.php';
</script>";
        exit;
    }
}

// Si el proveedor es el mismo o es el primer producto de la compra, insertamos el detalle
$sql = "INSERT INTO tb_detalle_compras (nro_compra, id_producto, cantidad_producto, precio_unitario, id_proveedor) VALUES ('$nro_compra', '$id_producto', '$cantidad', '$precio_unitario', '$id_proveedor')";

if ($mysqli->query($sql)) {
    echo "<script>
    window.location.href = '$URL/compras/create.php';
</script>";
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar la compra";
    $_SESSION['icono'] = "error";
    echo "<script>
    window.location.href = '$URL/compras/create.php';
</script>";
}
