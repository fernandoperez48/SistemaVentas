<?php

include '../../config.php';

$id_compra = $_GET['id_compra'];
$id_producto = $_GET['id_producto'];
$stock_actual = $_GET['stock_actual'];
$cantidad_compra = $_GET['cantidad_compra'];

$mysqli->begin_transaction();

$sentencia = $mysqli->prepare("DELETE FROM tb_compras WHERE id_compra=?");

$sentencia->bind_param('i', $id_compra);

if ($sentencia->execute()) {
    // Actualizar el stock desde la compra
    $stock = $stock_actual - $cantidad_compra;
    $sentencia = $mysqli->prepare("UPDATE tb_almacen 
        SET stock=? WHERE id_producto=?");

    $sentencia->bind_param('ii', $stock, $id_producto);
    $sentencia->execute();

    $mysqli->commit();

    session_start();
    $_SESSION['mensaje'] = "Se eliminó la compra correctamente";
    $_SESSION['icono'] = "success";
?>

    <script>
        window.location.href = '<?php echo $URL; ?>/compras/';
    </script>

<?php
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