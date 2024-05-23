<?php

include '../../config.php';

$id_producto = $_GET['id_producto'];
$nro_compra = $_GET['nro_compra'];
$fecha_compra = $_GET['fecha_compra'];
$id_proveedor = $_GET['id_proveedor'];
$comprobante = $_GET['comprobante'];
$precio_compra = $_GET['precio_compra'];
$cantidad_compra = $_GET['cantidad_compra'];
$id_usuario = $_GET['id_usuario'];
$stock_total = $_GET['stock_total'];

$mysqli->begin_transaction();

$sentencia = $mysqli->prepare("INSERT INTO tb_compras
    (id_producto,nro_compra,fecha_compra,id_proveedor,comprobante,precio_compra,cantidad,id_usuario,fyh_creacion)
    VALUES (?,?,?,?,?,?,?,?,?)");

$fyh_creacion = date('Y-m-d H:i:s');

$sentencia->bind_param('isssssiss', $id_producto, $nro_compra, $fecha_compra, $id_proveedor, $comprobante, $precio_compra, $cantidad_compra, $id_usuario, $fyh_creacion);

if ($sentencia->execute()) {
    // Actualiza el stock desde la compra
    $sentencia = $mysqli->prepare("UPDATE tb_almacen 
        SET  stock=? WHERE id_producto=?");

    $sentencia->bind_param('ii', $stock_total, $id_producto);
    $sentencia->execute();

    $mysqli->commit();

    session_start();
    $_SESSION['mensaje'] = "Se registró la compra correctamente";
    $_SESSION['icono'] = "success";
?>

    <script>
        window.location.href = '<?php echo $URL; ?>/compras/';
    </script>

<?php
} else {
    $mysqli->rollback();

    session_start();
    $_SESSION['mensaje'] = "No se pudo registrar la compra";
    $_SESSION['icono'] = "error";
?>

    <script>
        window.location.href = '<?php echo $URL; ?>/compras/create.php';
    </script>

<?php
}

?>