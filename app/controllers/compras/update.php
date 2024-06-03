<?php

include '../../config.php';

$id_compra = $_GET['id_compra'];
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

$sql = "UPDATE tb_compras SET 
    id_producto='$id_producto',
    nro_compra='$nro_compra',
    fecha_compra='$fecha_compra',
    id_proveedor='$id_proveedor',
    comprobante='$comprobante',
    precio_compra='$precio_compra',
    cantidad='$cantidad_compra',
    id_usuario='$id_usuario',
    fyh_actualizacion='$fechaHora'
    WHERE id_compra='$id_compra'";

if ($mysqli->query($sql)) {
    // Actualiza el stock desde la compra
    $sql = "UPDATE tb_almacen SET stock='$stock_total' WHERE id_producto='$id_producto'";
    if ($mysqli->query($sql)) {
        $mysqli->commit();

        session_start();
        $_SESSION['mensaje'] = "Se actualizó la compra correctamente";
        $_SESSION['icono'] = "success";
?>
        <script>
            window.location.href = '<?php echo $URL; ?>/compras/';
        </script>
    <?php
    } else {
        $mysqli->rollback();

        session_start();
        $_SESSION['mensaje'] = "No se pudo actualizar el stock";
        $_SESSION['icono'] = "error";
    ?>
        <script>
            window.location.href = '<?php echo $URL; ?>/compras';
        </script>
    <?php
    }
} else {
    $mysqli->rollback();

    session_start();
    $_SESSION['mensaje'] = "No se pudo actualizar la compra";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        window.location.href = '<?php echo $URL; ?>/compras';
    </script>
<?php
}

?>