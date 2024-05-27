<?php

include_once '../../config.php';

$nro_compra = $_GET['nro_compra'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$precio_unitario = $_GET['precio_unitario'];
$id_proveedor = $_GET['id_proveedor'];

$sql = "INSERT INTO tb_detalle_compras (nro_compra, id_producto, cantidad_producto, precio_unitario) VALUES ('$nro_compra', '$id_producto', '$cantidad', '$precio_unitario')";

if ($mysqli->query($sql)) {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/compras/create.php';
    </script>
<?php
} else {
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