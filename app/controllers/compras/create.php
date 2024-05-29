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

$fyh_creacion = date('Y-m-d H:i:s');

$mysqli->begin_transaction();

// Inserta la compra
$insert_query = "INSERT INTO tb_compras (nro_compra, fecha_compra_pago, id_proveedor, comprobante, precio_compra, cantidad, id_usuario, fyh_creacion) 
VALUES ('$id_producto', '$nro_compra', '$fecha_compra', '$id_proveedor', '$comprobante', '$precio_compra', '$cantidad_compra', '$id_usuario', '$fyh_creacion')";

if ($mysqli->query($insert_query) === TRUE) {
    // Actualiza el stock
    $update_query = "UPDATE tb_almacen SET stock='$stock_total' WHERE id_producto='$id_producto'";

    if ($mysqli->query($update_query) === TRUE) {
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