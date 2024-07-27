<?php
include '../../config.php';

$id_carrito = $_POST['id_carrito'];

// Obtener la cantidad y el id del producto antes de borrar
$sql_get = "SELECT id_producto, cantidad FROM tb_carrito WHERE id_carrito='$id_carrito'";
$result_get = $mysqli->query($sql_get);
$row = $result_get->fetch_assoc();
$id_producto = $row['id_producto'];
$cantidad = $row['cantidad'];

// Borrar el producto del carrito
$sql_delete = "DELETE FROM tb_carrito WHERE id_carrito='$id_carrito'";

if ($mysqli->query($sql_delete) === TRUE) {
    // Revertir stock
    $sql_stock = "UPDATE tb_almacen SET stock = stock + $cantidad WHERE id_producto = '$id_producto'";
    $mysqli->query($sql_stock);
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php
} else {
?>
    <script>
        window.location.href = '<?php echo $URL; ?>/ventas/create.php';
    </script>
<?php }

$mysqli->close();
?>